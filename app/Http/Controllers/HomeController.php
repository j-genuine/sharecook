<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();

        $reservations = array();
        $i=0;
        $user_reservations = $user->userReservations()
            ->select("user_reservations.id","worker_schedule_id","visit_time","price","message")
            ->leftjoin("worker_schedules","worker_schedules.id","=","worker_schedule_id")
            ->orderBy("date_key","desc")->paginate(5);

        // 予約情報を一件毎に、各項目を成型した上で、view渡し用に配列に格納
        foreach ($user_reservations as $reservation){

            //成型されたスケジュール情報とシェフ情報をまとめて配列で取得
            $reservations[$i] = $reservation->workerSchedule()->first()->scheduleInfo();
            
            //予約テーブル情報は独自で成型
            $visit_time = $reservation->visit_time;
            $reservations[$i]['visit_time_str'] = $visit_time ? substr($visit_time, 0, 5) : "指定なし";
            $price = $reservation->price;
            $reservations[$i]['price_str'] = $price ? "￥".number_format($price) : "応談(心付け)";
            $reservations[$i]['id'] = $reservation->id;
            
            $i++;
        }

        return view('home', [
            'user' => $user,
            'reservations' => $reservations,
            'reserve_pagelinks' => $user_reservations->links(),
        ]);
    }
}
