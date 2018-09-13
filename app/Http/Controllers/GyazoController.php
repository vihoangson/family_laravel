<?php

namespace App\Http\Controllers;

use App\Traits\Cloudinary_trait;

use App\Http\Controllers\Controller as Controller;

use Illuminate\Http\Request;

class GyazoController extends Controller
{

    use Cloudinary_trait;

    public function gyazo(Request $request)
    {
        $name      = date('Ymd_Hmi') . "_" . time() . ".png";
        $path      = $request->file('imagedata')
                             ->storeAS('public/images/Gyazo', $name);
        $file_path = public_path('/storage/images/Gyazo/' . $name);
        if (file_exists($file_path)) {
            $this->CloudinaryUploadImg($file_path, 'Gyazo');
            unlink($file_path);
            echo env('APP_URL').'/upload?file=' . base64_encode($name);
        } else {
            echo "Can't update file";
        }
        die;
    }

}
