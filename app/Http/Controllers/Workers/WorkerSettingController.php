<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Worker;
use App\Workers\TempWorker;


class WorkerSettingController extends Controller
{
    /**
     * シェフ会員プロフィール編集ページ
     */
    public function edit()
    {
        $worker = \Auth::user();
        
        //希望エリアIDを、第一希望から3件取得
        $area_ids = array();
        $worker_areas = $worker->workerAreas()->orderBy("priority_flag")->get();
        
        foreach($worker_areas as $worker_area){
            array_push($area_ids, $worker_area->area_id);
        }
        $area_ids = array_pad($area_ids, 3, 0);

        //得意スキルIDを、第一優先から3件取得
        $skill_ids = array();
        $worker_skills = $worker->workerSkills()->orderBy("priority_flag")->get();
        
        foreach($worker_skills as $worker_skill){
            array_push($skill_ids, $worker_skill->skill_id);
        }
        $skill_ids = array_pad($skill_ids, 3, 0);

        //selectボックス用に全エリアIDとエリア名配列を作成
        $area_array = \App\Area::get()->pluck("name","id");
        //同様に全スキルIDとスキル名も
        $skill_array = \App\Skill::get()->pluck("name","id");
 
        return view('workers.setting', [
            'worker' => $worker,
            'area_ids' => $area_ids,
            'skill_ids' => $skill_ids,
            'area_array' => $area_array,
            'skill_array' => $skill_array,
        ]);

    }

    /**
     * シェフ会員プロフィール更新処理
     */
    public function update(Request $request)
    {
        $worker = \Auth::user();

        $request->validate([

            'name' => 'required|string|max:30',
            'nickname' => 'required|string|max:12',
            'phone' => 'required|string|max:13',
            'price_lunch' => 'nullable|integer|max:99999',
            'price_dinner' => 'nullable|integer|max:99999',
            'amature_career' => 'nullable|numeric|max:255',
            'pro_career' => 'nullable|numeric|max:255',
            'comment' => 'max:2000',
        ]);
        
        //メールアドレスの変更があれば、ユニークチェック
        //if($request->email != $worker->email){
        //    $request->validate(['email' => 'required|string|email|max:255|unique:workers']);
        //    $worker->email = $request->email;
        //}
        
        //パスワードの入力（変更意図）があれば、チェックと更新
        if($request->password){
            $request->validate(['password' => 'string|min:8|confirmed']);
            $worker->password = Hash::make($request->password);
        }
        
        //希望エリアID（出張可能エリアテーブルを更新）
        $worker->workerAreas()->delete(); // 優先度変更時に重複を避けるため、一旦現在のレコードを削除
        $area_ids = array_unique($request->area_ids); // 重複入力があれば、重複分の配列削除

        $i=0;
        foreach($area_ids as $area_id){
            //地域名マスタにあるエリアIDであれば、レコード挿入
            if( \App\Area::find($area_id) ){
                $worker->workerAreas()->create(['area_id' => $area_id, 'priority_flag' => $i]);
            }
            $i++;
        }
        
        //得意スキルID（得意スキルテーブルを更新）
        $worker->workerSkills()->delete(); // 優先度変更時に重複を避けるため、一旦現在のレコードを削除
        $skill_ids = array_unique($request->skill_ids); // 重複入力があれば、重複分の配列削除

        $i=0;
        foreach($skill_ids as $skill_id){
            //料理スキルマスタにあるスキルIDであれば、レコード挿入
            if( \App\Skill::find($skill_id) ){
                $worker->workerSkills()->create(['skill_id' => $skill_id, 'priority_flag' => $i]);
            }
            $i++;
        }
        
        $worker->public_flag = $request->public_flag;
        $worker->name = $request->name;
        $worker->nickname = $request->nickname;
        $worker->phone = $request->phone;
        $worker->price_lunch = $request->price_lunch;
        $worker->price_dinner = $request->price_dinner;
        $worker->amature_career = $request->amature_career;
        $worker->pro_career = $request->pro_career;
        $worker->comment = $request->comment;
        
        $worker->save();
        
        return back()->withStatus("保存しました");
    
    }
    
    /**
     * プロフィール画像のアップロード
     */
    public function storeImage(Request $request)
    {

        $worker = \Auth::user();

        //POSTされたファイルの一時パス取得
        $image = $request->file('image');
        if(!$image) return back()->withStatus("ファイルが選択されていません。");  //ファイルが空なら終了
        $image_name = $image->getRealPath();
        if(!@getimagesize($image_name)) return back()->withStatus("画像ファイルを選択してください。");  //画像ファイルで無ければ終了

        //旧ファイルがある場合、削除と登録抹消
        if( $worker->portrait_filename ){
            $worker->destroyPortraitImage();
            $worker->portrait_filename = "";
        }
        
        //アップロード処理
        $worker->portrait_filename = Worker::uploadPortraitImage($image_name, $worker->id);
        if(!$worker->portrait_filename) return back()->withStatus("サーバエラーにより保存できませんでした。");

        //DBに保存
        $worker->save();

        return back()->withStatus("プロフィール画像を保存しました");
    }

    /**
     * メールアドレス変更（メール送信フォーム）ページ表示
     *
     * @return view
     */
    protected function emailChangeForm(){

        return view('workers.email_change');
    }

    /**
     * メールアドレス変更仮登録（メール送信）処理
     *
     * @param  Request $request
     * @return redirect
     */
    protected function emailTempUpdate(Request $request){

        $request->validate(['email' => 'required|string|email|max:255|unique:workers']);

        //シェフ仮会員テーブルにレコード作成
        $temp_worker = TempWorker::store($request['email']);

        //登録お知らせメール送信
        Mail::send(new \App\Mail\WorkerEmailUpdate($temp_worker));

        return back()->withStatus("メールの送信が完了しました。メールに記載されたURLにアクセスし、登録を完了してください。");
    }

     /**
     * メールアドレス変更本登録処理
     *
     * @param  Request $request
     * @return redirect
     */
    public function emailUpdate(Request $request){

        $worker = \Auth::user();
        
        //Hashが無ければ、メール変更ページへリダイレクト
        if(!isset($request['HASH'])) return redirect("/workers/email_change");
        //仮登録Hashが無効な場合はエラーメッセージ付きでメール変更ページへ
        $temp_worker = TempWorker::where('hash',$request['HASH'])->first();
        if(!isset($temp_worker->email)) return redirect("/workers/email_change")
        ->withStatus('メール登録情報が見つかりませんでした。アドレスを再送信してください。（※仮登録後24時間が過ぎていたり、URLが途中で途切れていないかご確認ください）');

        //一応重複登録をしていないかチェック
        if( Worker::where('email',$temp_worker->email)->first() ) return redirect("/workers/email_change")
        ->withStatus('送信されたメールアドレスは既に使用されています。');
        
        //emailを更新
        $worker->email = $temp_worker->email;
        $worker->save();

        //仮会員テーブルからデータを削除
        TempWorker::clean($temp_worker->email);

        return redirect("/workers/setting")->withStatus("メールアドレスの変更が完了しました。");
    }

    /**
     * シェフ会員退会確認ページ
     */
    public function unscribe()
    {
        $worker = \Auth::user();

        return view('workers.unscribe', [
            'worker' => $worker,
        ]);
    }

    /**
     * シェフ会員退会処理
     */
    public function destroy(Request $request)
    {
        $worker = \Auth::user();

        //メールアドレス入力により誤操作・不正アクセスの簡易チェック
        if($request->check_str != $worker->email) return back()->withStatus("メールアドレスが登録データと一致しません。");

        //カスタマー予約テーブルのデータ削除
        $worker_shedule_id = $worker->workerSchedules()->select("id")->get()->pluck("id");
        \App\Users\UserReservation::whereIn("worker_schedule_id", $worker_shedule_id)->delete();

        //料理画像本体とテーブルのデータ削除
        foreach($worker->workImages()->get() as $work_image){
            $work_image->destroyWorkImage();
            $work_image->delete();
        }

        //スケジュールテーブル、出張エリアテーブル、得意スキルテーブルのデータ削除
        $worker->workerSchedules()->delete();
        $worker->workerAreas()->delete();
        $worker->workerSkills()->delete();

        //プロフィール画像とシェフ会員テーブルのデータ削除
        $worker->destroyPortraitImage();
        \Log::info('Worker Unscribed: '.$worker->id.", ".$worker->name.", ".$worker->nickname.", ".$worker->email.", ".$worker->created_at);
        $worker->delete();

        return view('workers.unscribe_complete');
    }
}
