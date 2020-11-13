<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;

class IndexController extends Controller
{
    public function index(){
   	
        $workers = Worker::where("public_flag",1)->orderBy('updated_at', 'desc')->paginate(10);

        return view('index', [
            'workers' => $workers,
        ]);
   	
	}
}
