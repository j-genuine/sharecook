<?php

namespace App\Http\Controllers\Workers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Worker;
use App\Workers\TempWorker;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::WORKERS_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:workers');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:workers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nickname' => ['required','string','max:12'],
            'phone' => ['required','string','max:13'],
            'price_lunch' => ['nullable','integer','max:99999'],
            'price_dinner' => ['nullable','integer','max:99999'],
            'amature_career' => ['nullable','numeric','max:255'],
            'pro_career' => ['nullable','numeric','max:255'],
            'comment' => ['max:2000'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $worker = Worker::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'nickname' => $data['nickname'],
            'price_lunch' => $data['price_lunch'],
            'price_dinner' => $data['price_dinner'],
            'amature_career' => $data['amature_career'],
            'pro_career' => $data['pro_career'],
            'comment' => $data['comment'],
        ]);
        
        //希望エリアID（出張可能エリアテーブルを更新）
        $area_ids = array_unique($data['area_ids']); // 重複入力があれば、重複分の配列削除

        $i=0;
        foreach($area_ids as $area_id){
            //地域名マスタにあるエリアIDであれば、レコード挿入
            if( \App\Area::find($area_id) ) $worker->workerAreas()->create(['area_id' => $area_id, 'priority_flag' => $i]);
            $i++;
        }
        
        //得意スキルID（得意スキルテーブルを更新）
        $skill_ids = array_unique($data['skill_ids']); // 重複入力があれば、重複分の配列削除

        $i=0;
        foreach($skill_ids as $skill_id){
            //料理スキルマスタにあるスキルIDであれば、レコード挿入
            if( \App\Skill::find($skill_id) ) $worker->workerSkills()->create(['skill_id' => $skill_id, 'priority_flag' => $i]);
            $i++;
        }
        
        return $worker;
    }
    
    /**
     * シェフ本会員登録ページ表示
     * ※RegisterUsers.phpのメソッドをworkers用に上書き
     */
    public function showRegistrationForm(array $data)
    {
        //仮登録者以外はアクセス不可
        $temp_worker = TempWorker::where('hash',$data['HASH'])->first();
        if(!isset($temp_worker->email)){
            $error_msg = $data['HASH'] ? ('メール登録情報が見つかりませんでした。下記をご確認の上、メールを再送信ください。<ul><li>仮登録後24時間が過ぎていないか</li><li>URLが途中で途切れていないか</li></ul>') : "";
            redirect("/worker/temp_register")->with($error_msg);
        }

        //selectボックス用に全エリアIDとエリア名配列を作成
        $area_array = \App\Area::get()->pluck("name","id");
        //同様に全スキルIDとスキル名も
        $skill_array = \App\Skill::get()->pluck("name","id");
        
        return view('workers.auth.register', [
            'area_array' => $area_array,
            'skill_array' => $skill_array,
            'email' => $temp_worker->email,
        ]);
    }
    // guard変更
    protected function guard(){
        return Auth::guard('workers');
    }
    
    /**
     * シェフ会員仮登録（メール送信）ページ表示
     *
     * @return view
     */
    protected function tempCreate(){

        return view('workers.temp_register');
    }

    /**
     * シェフ会員仮登録処理
     *
     * @param  array  $data
     * @return view
     */
    protected function tempStore(array $data){

        $data->validate(['email' => 'required|string|email|max:255|unique:workers']);

        //シェフ仮会員テーブルから一日前以上のデータを削除後、レコード作成
        TempWorker::whereDate('created_at',"<", date("Y-m-d",strtotime("-1 day")))->delete();
        $temp_worker = TempWorker::create([
            'email' => $data['email'],
            'hash' => sha1(uniqid(mt_rand(), true)),    //照合用のハッシュキー生成
        ]);

        //本登録お知らせメール送信
        Mail::send(new \App\Mail\TempRegister($temp_worker));

        return view('workers.temp_register_complete', [
            'temp_worker' => $temp_worker,
        ]);
    }

}
