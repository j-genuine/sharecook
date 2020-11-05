<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Users\UserReservation;

class WorkersHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:workers');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $worker = \Auth::user();
        
        //希望エリア名を全件取得し表示用に成型
        $worker_area_name = "";
        $worker_areas = $worker->workerAreas()->orderBy("priority_flag")->get();
        $i=1;
        foreach($worker_areas as $worker_area){
            $worker_area_name .= $i++.": ".$worker_area->Area()->value("name")." ";
        }

        //得意スキル名を全件取得し表示用に成型
        $worker_skill_name = "";
        $worker_skills = $worker->workerSkills()->orderBy("priority_flag")->get();
        $i=1;
        foreach($worker_skills as $worker_skill){
            $worker_skill_name .= $i++.": ".$worker_skill->Skill()->value("name")." ";
        }
        
        // 予約情報を一件毎に、各項目を成型した上で、view渡し用に配列に格納
        $reservations = array();
        $i=0;
        $user_reservations = UserReservation::workerReservedInfo($worker->id);
        
        foreach ($user_reservations as $reservation){

            $date_key = $reservation->date_key;
            $reservations[$i]['date_str'] = substr($date_key,0,4)."/".substr($date_key,4,2)."/".substr($date_key,-2);
            $visit_time = $reservation->visit_time;
            $reservations[$i]['visit_time_str'] = $visit_time ? substr($visit_time, 0, 5) : "指定なし";
            $reservations[$i]['comment'] = $reservation->comment;
            $price = $reservation->price;
            $reservations[$i]['price_str'] = $price ? "￥".number_format($price) : "応談(心付け)";
            $reservations[$i]['meal_type'] = $reservation->noon_flag==1 ? 'ランチ' : 'ディナー';
            $reservations[$i]['message'] = $reservation->message;
            $reservations[$i]['worker_id'] = $reservation->worker_id;
            
            $user = \App\User::find($reservation->user_id);
            $reservations[$i]['user_name'] =  $user->name;
            $reservations[$i]['user_address'] =  $user->address;
            $reservations[$i]['user_phone'] =  $user->phone;

            $i++;
        }

        return view('workers.home', [
            'worker' => $worker,
            'reservations' => $reservations,
            'worker_area_name' => $worker_area_name,
            'worker_skill_name' => $worker_skill_name,
        ]);
    }
}
