<?php

return [

    // CloudinaryのAPI Environment variable（インスタンス作成時に使用）
    'cloudinary_url' => env('CLOUDINARY_URL'),
    
    // プロフィール画像アップロード先フォルダ名
    'portrait_folder' => env('UPLOAD_PORTRAIT_FOLDER'),
    
    // 料理イメージ画像アップロード先フォルダ名
    'portrait_folder' => env('UPLOAD_PORTRAIT_FOLDER'),
    'work_image_folder' => env('UPLOAD_WORK_IMAGE_FOLDER'),
    
];