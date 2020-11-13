<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\InquiryMail;

class InquiryController extends Controller
{
    public function form(){
   
        return view('inquiry.form');
       	
	}
	
    public function send(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255',
            'category' => 'required',
            'message' => 'required|string|max:5000',
        ]);
        
        Mail::send(new InquiryMail($request));

        return view('inquiry.complete');
        
    }
}
