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
use Illuminate\Http\Request;

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

        //仮登録データを削除
        TempWorker::clean($data['email']);
        
        return $worker;
    }
    
    /**
     * シェフ本会員登録ページ表示
     * ※RegisterUsers.phpのメソッドをworkers用に上書き
     */
    public function showRegistrationForm(Request $request)
    {
        //先に仮会員テーブルから有効期限切れデータを削除
        TempWorker::clean();

        //仮登録者で無い(直接アクセス)なら仮登録ページへリダイレクト
        if(!isset($request['HASH'])) return redirect("/workers/temp_register");
        //仮登録Hashが無効な場合はエラーメッセージ付きで仮登録ページへ
        $temp_worker = TempWorker::where('hash',$request['HASH'])->first();
        if(!isset($temp_worker->email)) return redirect("/workers/temp_register")
        ->with('status','メール登録情報が見つかりませんでした。アドレスを再送信してください。（※仮登録後24時間が過ぎていたり、URLが途中で途切れていないかご確認ください）');

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
     * @param  Request $request
     * @return view
     */
    protected function tempStore(Request $request){

        $request->validate(['email' => 'required|string|email|max:255|unique:workers']);

        //シェフ仮会員テーブルにレコード作成
        $temp_worker = TempWorker::store($request['email']);

        //本登録お知らせメール送信
        Mail::send(new \App\Mail\TempRegister($temp_worker));

        return view('workers.temp_register_complete', [
            'temp_worker' => $temp_worker,
        ]);
    }

}
