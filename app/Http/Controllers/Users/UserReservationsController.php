<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Calendar\WorkerSchedule;
//use App\Worker;
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
		
		//予約日を成型
		$date_key = $worker_schedule->date_key;
		$date_str = substr($date_key,0,4)."年".substr($date_key,4,2)."月".substr($date_key,-2)."日";
		//ディナー／ランチ区分
		if($worker_schedule->noon_flag == 1){
    		$meal_type_str = "ランチ";
    		$price = $worker->price_lunch;
    		$visit_time = array('11:00' =>'11:00', '12:00' =>'12:00', '13:00' =>'13:00', '14:00' =>'14:00', '15:00' =>'15:00');
		}else{
    		$meal_type_str = "ディナー";
    		$price = $worker->price_dinner;
    		$visit_time = array('17:00' =>'17:00', '18:00' =>'18:00', '19:00' =>'19:00', '20:00' =>'20:00', '21:00' =>'21:00');
		}

		//価格を成型
		$price_str = $price ? "￥".number_format($price) : "指定なし";

		return view('users.reserve.create', [
			"worker_schedule" => $worker_schedule,
			"worker" => $worker,
			"date_str" => $date_str,
			"meal_type_str" => $meal_type_str,
			"price_str" => $price_str,
			"price" => $price,
			"visit_time" => $visit_time,
		]);
    }

    /**
     * 予約申し込み処理
     */
    public function store(Request $request)
    {
    	// 予約済みのidは不可
		if( $request->user()->userReservations()->where("worker_schedule_id",$request->worker_schedule_id)->first() ){
            return view('error', ["message" => '申し訳ございません。指定されたスケジュールは予約済みのため、お手続きができません。', "return_url" => "/home" ]);
		}

        $request->validate([
            'message' => 'max:1000',
        ]);
        
       $request->user()->userReservations()->create([
            'worker_schedule_id' => $request->worker_schedule_id,
            'visit_time' => $request->visit_time,
            'message' => $request->message,
            'price' => $request->price,
        ]);

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

		//予約日を成型
		$date_key = $worker_schedule->date_key;
		$date_str = substr($date_key,0,4)."年".substr($date_key,4,2)."月".substr($date_key,-2)."日";
		//ディナー／ランチ区分
		if($worker_schedule->noon_flag == 1){
    		$meal_type_str = "ランチ";
		}else{
    		$meal_type_str = "ディナー";
		}

		return view('users.reserve.edit', [
			"user_reservation" => $user_reservation,
			"worker_schedule" => $worker_schedule,
			"worker" => $worker,
			"date_str" => $date_str,
			"meal_type_str" => $meal_type_str,
			"price_str" => $price_str,
			"visit_time_str" => $visit_time_str,
		]);
    }

    /**
     * 予約キャンセル処理
     */
    public function destroy($id)
    {
	    $user_reservation = UserReservation::findOrFail($id);
	    
	    $user_reservation->delete();
	    
	    return redirect('/home');
    }
}
