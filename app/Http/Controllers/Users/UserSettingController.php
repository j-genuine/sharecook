<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    public function edit()
    {
        $user = \Auth::user();
        
        return view('users.setting', [
            'user' => $user,
        ]);

    }

    public function update(Request $request)
    {
        
        $user = \Auth::user();

        $request->validate([

            'name' => 'required|string|max:30',
            'phone' => 'required|string|max:13',
            'zip_cd' => 'required|integer|max:9999999',
            'area_id' => 'required|integer|max:999',
            'address' => 'required|string|max:511',
        ]);
   
        //メールアドレスの変更があれば、ユニークチェック
        if($request->email != $user->email){
            $request->validate(['email' => 'required|string|email|max:255|unique:users']);
            $user->email = $request->email;
        }
        
        //パスワードの入力（変更意図）があれば、チェックと更新
        if($request->password){
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->password = Hash::make($request->password);
        }
        
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->zip_cd = $request->zip_cd;
        $user->area_id = $request->area_id;
        $user->address = $request->address;
        
        $user->save();
        
        return back()->withStatus("保存しました");
    }
    
}
