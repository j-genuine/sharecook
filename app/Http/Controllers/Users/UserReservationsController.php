<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Calendar\WorkerSchedule;
use App\User;
use App\Users\UserReservation;

class UserReservationsController extends Controller
{

    /**
     * 予約申し込み確認画面
     */
    public function create(Request $request)
    {
        // クエリからworker_schedule_idを受け取る
		$worker_schedule_id = $request->wsid;

		// worker_scheduleとworkerの二種類の情報が必要なため、インスタンス生成
		$worker_schedule = WorkerSchedule::findOrFail($worker_schedule_id);
		$worker =  $worker_schedule->worker()->first();

        // 予約済みのidは不可
		if( $worker_schedule->userReservation()->value("id") ){
            return view('error', ["message" => '申し訳ございません。指定されたスケジュールは予約済みのため、お手続きができません。', "return_url" => "/workerinfo?wid=".$worker_schedule->worker_id ]);
		}
		
		// 成型されたスケジュール情報を取得
		$schedule_info = $worker_schedule->scheduleInfo();
		
		// 訪問時間の選択リスト
		$visit_time = ($worker_schedule->noon_flag == 1) ?
			array('11:00' =>'11:00', '12:00' =>'12:00', '13:00' =>'13:00', '14:00' =>'14:00', '15:00' =>'15:00') :
			array('17:00' =>'17:00', '18:00' =>'18:00', '19:00' =>'19:00', '20:00' =>'20:00', '21:00' =>'21:00');

		return view('users.reserve.create', [
			"worker_schedule" => $worker_schedule,
			"worker" => $worker,
			"date_str" => $schedule_info["date_jp"],
			"meal_type_str" => $schedule_info["meal_type"],
			"price_str" => $schedule_info["price_str"],
			"price" => $schedule_info["price"],
			"visit_time" => $visit_time,
		]);
    }

    /**
     * 予約申し込み処理
     */
    public function store(Request $request)
    {
    	// 予約済みのidは不可（予約確認中に他者に先約された場合等）
		if( $request->user()->userReservations()->where("worker_schedule_id",$request->worker_schedule_id)->first() ){
            return view('error', ["message" => '申し訳ございません。指定されたスケジュールは予約済みのため、お手続きができません。', "return_url" => "/home" ]);
		}

        $request->validate([
            'message' => 'max:1000',
        ]);
        
		$user_reservation = $request->user()->userReservations()->create([
            'worker_schedule_id' => $request->worker_schedule_id,
            'visit_time' => $request->visit_time,
            'message' => $request->message,
            'price' => $request->price,
        ]);
        
        // 予約発生通知メール送信
        Mail::send(new \App\Mail\ReserveMail($user_reservation));

        return redirect('/home');
        
    }

    /**
     * 予約キャンセル確認画面
     */
    public function edit($id)
    {

		// user_reservation、worker_schedule、worker、の３つのインスタンス生成
		$user_reservation = UserReservation::findOrFail($id);
		$worker_schedule = $user_reservation->workerSchedule()->first();
		$worker =  $worker_schedule->worker()->first();

		//価格と希望時間を成型
		$price = $user_reservation->price;
		$price_str = $price ? "￥".number_format($price) : "応談(心付け)";
		$visit_time = $user_reservation->visit_time;
		$visit_time_str = $visit_time ? substr($visit_time, 0, 5) : "指定なし";

		// 成型されたスケジュール情報を取得
		$schedule_info = $worker_schedule->scheduleInfo();

		return view('users.reserve.edit', [
			"user_reservation" => $user_reservation,
			"worker_schedule" => $worker_schedule,
			"worker" => $worker,
			"date_str" => $schedule_info["date_jp"],
			"meal_type_str" => $schedule_info["meal_type"],
			"price_str" => $schedule_info["price_str"],
			"visit_time_str" => $visit_time_str,
		]);
    }

    /**
     * 予約キャンセル処理
     */
    public function destroy($id)
    {
		// キャンセル理由を直接取得（destroyではrequestが取得できないため）
		$cancel_reason = $_POST["cancel_reason"];
		if(!$cancel_reason) return back()->withStatus("キャンセル理由を入力してください。");
		
		$user_reservation = UserReservation::findOrFail($id);
		
		// 予約キャンセル通知メール送信
		Mail::send(new \App\Mail\ReserveCancelMail($user_reservation, $cancel_reason));
		
		$user_reservation->delete();
		
		return redirect('/home');
    }
}
