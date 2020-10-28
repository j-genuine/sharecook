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

        // 予約情報を一件毎に、各項目を成型した上で、view渡し用に配列に格納
        foreach ($user->userReservations()->get() as $reservation){
               
            $date_key = $reservation->workerSchedule()->value('date_key');
            $reservations[$i]['date_str'] = substr($date_key,0,4)."/".substr($date_key,4,2)."/".substr($date_key,-2);
            $visit_time = $reservation->visit_time;
            $reservations[$i]['visit_time_str'] = $visit_time ? substr($visit_time, 0, 5) : "指定なし";
            $reservations[$i]['comment'] = $reservation->workerSchedule()->value('comment');
            $price = $reservation->price;
            $reservations[$i]['price_str'] = $price ? "￥".number_format($price) : "応談(心付け)";
            $reservations[$i]['meal_type'] = $reservation->workerSchedule()->value('noon_flag')==1 ? 'ランチ' : 'ディナー';
            $reservations[$i]['id'] = $reservation->id;
            $reservations[$i]['worker_id'] = $reservation->workerSchedule()->value('worker_id');
            
            $worker = \App\Worker::find($reservations[$i]['worker_id']);
            $reservations[$i]['nickname'] = $worker->nickname;
            $reservations[$i]['email'] = $worker->email;

            $i++;
        }

        return view('home', [
            'user' => $user,
            'reservations' => $reservations,
        ]);
    }
}
