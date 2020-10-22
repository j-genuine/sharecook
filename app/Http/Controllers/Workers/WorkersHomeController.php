<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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

        return view('workers.home', compact('worker'));
    }
}
