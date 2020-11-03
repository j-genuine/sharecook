<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

class TestController extends Controller
{
    public function postFile(Request $request)
    {

        $image = $request->file('image');

        $image_name = $image->getRealPath();

        // Cloudinaryへアップロード
        Cloudder::upload($image_name, null);
        list($width, $height) = getimagesize($image_name);
        // 直前にアップロードした画像のユニークIDを取得します。
        $publicId = Cloudder::getPublicId();
        // URLを生成します
        $logoUrl = Cloudder::show($publicId, [
            'width'     => $width,
            'height'    => $height
        ]);
        
        print $logoUrl;
        exit;
        

        //$path = Storage::disk('s3')->putFile('/', $image, 'public');
        //$storeimage = Storage::disk('s3')->url($path);

        //$image = new Image();
        //$uploadImg = $image->image = $request->file('image');
        //$image->image = Storage::disk('s3')->url($path);
        //$image->save();

        return back()->withStatus("プロフィール画像を保存しました:".$storeimage);
    }
}
