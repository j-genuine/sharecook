<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Workers\WorkImage;

class WorkImagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $worker = \Auth::user();
        $work_images = $worker->workImages()->orderBy('created_at', 'desc')->paginate(5);
        
        return view('workers.work_images.index', [
            'worker' => $worker,
            'work_images' => $work_images,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $worker = $request->user();
        $work_image = $worker->workImages();

        //POSTされたファイルの一時パス取得
        $image = $request->file('image');
        if(!$image) return back()->withStatus("ファイルが選択されていません。");  //ファイルが空なら終了
        $image_name = $image->getRealPath();
        if(!@getimagesize($image_name)) return back()->withStatus("画像ファイルを選択してください。");  //画像ファイルで無ければ終了

        //バリデーション
        $request->validate([
            'comment' => 'max:500',
        ]);
        
        //保存可能数チェック
        if(WorkImage::maxImageNum() <= $work_image->count()) return back()->withStatus("保存数が最大値(".WorkImage::maxImageNum()."枚)を超えています。");

        //アップロード処理
        $upload_filename = WorkImage::uploadWorkImage($image_name, $worker->id);
        if(!$upload_filename) return back()->withStatus("サーバエラーにより保存できませんでした。");
        
        //DBに保存
        $worker->workImages()->create([
            'worker_id' => $worker->id,
            'image_filename' => $upload_filename,
            'comment' => $request->comment,
        ]);

        return back()->withStatus("画像を保存しました");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = \Auth::user();
        $work_images = $worker->workImages()->orderBy('created_at', 'desc')->paginate(5);
        
        $work_image = WorkImage::findOrFail($id);
		$worker =  $work_image->worker()->first();
        
        return view('workers.work_images.edit', [
            'work_image' => $work_image,
            'worker' => $worker,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $work_image = $request->user()->workImages()->where("id",$id)->first();
       if(!$work_image) return back()->withStatus("画像情報が取得できませんでした。");
       
       $work_image->comment = $request->comment;
       $work_image->save();
       
       return back()->withStatus("更新しました");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = \Auth::user();
        $work_image = $worker->workImages()->where("id",$id)->first();
        if(!$work_image) return back()->withStatus("画像情報が取得できませんでした。");
        
        //クラウド上の画像削除
        $work_image->destroyWorkImage();
        
        $work_image->delete();
        
        return redirect(route('workers.work_images.index'))->withStatus("1件削除しました");
    }
}
