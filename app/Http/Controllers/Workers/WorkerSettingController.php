<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
use Cloudinary;

class WorkerSettingController extends Controller
{

    //プロフィール画像の保存先クラウド上のフォルダ名
    public $portrait_folder = "portrait";
    
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
 
        //プロフィール画像表示のimg要素を作成
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));

        $portrait_filename_info = pathinfo($worker->portrait_filename);
        $public_id = $portrait_filename_info['filename'];
        $portrait_img_tag = $public_id ? $cloudinary->imageTag($this->portrait_folder."/".$public_id)->fill(150, 150)
            : '<img src="/image/portrait_dummy.png" />';

        return view('workers.setting', [
            'worker' => $worker,
            'area_ids' => $area_ids,
            'skill_ids' => $skill_ids,
            'area_array' => $area_array,
            'skill_array' => $skill_array,
            'portrait_img_tag' => $portrait_img_tag,
        ]);

    }

    /**
     * シェフ会員プロフィール更新処理
     */
    public function update(Request $request)
    {
        $worker = \Auth::user();

        $request->validate([

            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'phone' => 'required|string|max:13',
            'price_lunch' => 'integer|max:99999',
            'price_dinner' => 'integer|max:99999',
            'amature_career' => 'numeric|max:255',
            'pro_career' => 'numeric|max:255',
            'comment' => 'max:2000',
        ]);
        
        //メールアドレスの変更があれば、ユニークチェック
        if($request->email != $worker->email){
            $request->validate(['email' => 'required|string|email|max:255|unique:workers']);
            $worker->email = $request->email;
        }
        
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
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
        
        //POSTされたファイルの一時パス取得
        $image = $request->file('image');
        if(!$image) return back();  //ファイルが空なら終了
        $image_name = $image->getRealPath();

        //旧ファイルがある場合、削除と登録抹消
        $current_filename = pathinfo($worker->portrait_filename);
        $current_public_id = $current_filename['filename'];
        if( $current_public_id ){
            $cloudinary->uploadApi()->destroy($this->portrait_folder.'/'.$current_public_id);
            $worker->portrait_filename = "";
        }

        //新規でpublic_id作成
        $public_id = $worker->id."_".crc32(time());
        //Cloudinaryにアップロード
        $upload_image = $cloudinary->uploadApi()->upload($image_name, ['public_id' => $public_id, 'folder' => $this->portrait_folder]);
        
        $upload_filename = basename($upload_image["url"]);
        $worker->portrait_filename = "$upload_filename";
        
        //DBに保存
        $worker->save();

        return back()->withStatus("プロフィール画像を保存しました");
    }
    
}
