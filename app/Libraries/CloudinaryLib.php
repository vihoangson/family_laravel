<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CloudinaryLib
{

    public function __construct()
    {
    }

    /**
     * @param        $path
     * @param string $folderInCloud
     *
     * @return bool|mixed
     * @author hoang_son
     */
    public static function uploadImg($path, $folderInCloud = '')
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        if (preg_match('/(\.jpg|\.png)$/', $path)) {
            if (file_exists($path)) {
                $response = \Cloudinary\Uploader::upload($path, [
                    "folder"           => "my_folder/" . $folderInCloud . '/',
                    "public_id"        => pathinfo($path)['filename'],
                    "overwrite"        => true,
                    "notification_url" => "http://vihoangson.com",
                    "resource_type"    => "image"
                ]);

                return $response;
            }
        }

        return false;
    }

    public static function uploadAllImgInStorage()
    {
        set_time_limit(1200);

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        // Lấy tất cả file trong storage
        $images_in_local = Storage::allFiles();

        $set_folder_cloud = 'upload_img_'.time();

        //todo: get list image in cloud
        $images_in_cloud = CloudinaryLib::getAllImage();

        //todo: compare with local
        //todo: lấy ra những file trên cloud chưa có

        $m=[];
        foreach ($images_in_local as $key => $v){
            $m[$key] = basename($v);
        }

        foreach ($images_in_cloud as $value){

            $rs = array_search(basename($value['url']),$m);

            if($rs !== false){
                // Xóa phần tử nếu đã có trên cloud
                dump($images_in_local[$rs]);
                unset($images_in_local[$rs]);
            }
        }

        // Chưa cần thực hiện chỉ thực hiện 1 lần lúc set up ban đầu cloud
        return ;

        //todo: upload các file trên kia chưa có
        //<editor-fold desc="Tiến hành up lên cloud">
        foreach ($images_in_local as $k => $v) {

            //<editor-fold desc="Giới hạn 1 lần up hình lên cloud">
            if ($k > env('limit_up_to_cloud', 3)) {
                continue;
            }
            //</editor-fold>

            //<editor-fold desc="Tiến hành up">
            if (preg_match('/(\.jpg|\.png)$/', $v)) {
                $path = storage_path('app/' . $v);
                if (file_exists($path)) {
                    \Cloudinary\Uploader::upload($path, [
                        "folder"           => $set_folder_cloud . "/",
                        "public_id"        => pathinfo($path)['filename'],
                        "overwrite"        => true,
                        "notification_url" => "https://requestb.in/12345abcd",
                        "resource_type"    => "image"
                    ]);
                }
            }
            //</editor-fold>
        }
        //</editor-fold>
    }

    /**
     * @param        $path
     * @param string $folder_name
     */
    public static function uploadFileRaw($path, $folder_name = 'folder_file_raw')
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $random_name_folder = $folder_name;
        \Cloudinary\Uploader::upload($path, [
            "folder"           => $random_name_folder . "/",
            "public_id"        => basename($path),
            "overwrite"        => true,
            "notification_url" => "https://requestb.in/12345abcd",
            "resource_type"    => "raw"
        ]);
    }

    /**
     * @return mixed
     * @author hoang_son
     */
    public static function getAllImage()
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:image ')
                               ->sort_by('version', 'desc')
                               ->max_results(config('configfamily.max_result_cloud'))
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];

        return $links;
    }

    public static function getImageInFolder($folderName)
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;

        $result    = $searching->expression('resource_type:image AND folder='.$folderName)
                               ->sort_by('version', 'desc')
                               ->max_results(config('configfamily.max_result_cloud'))
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];

        return $links;
    }

    /**
     * @return mixed
     * @author hoang_son
     */
    public static function getAllRaw()
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:raw')
                               ->sort_by('version', 'desc')
                               ->max_results(config('configfamily.max_result_cloud'))
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];

        return $links;
    }

    /**
     * Chức năng lấy dữ liệu toàn bộ file backup về
     *
     * @return mixed
     * @author hoang_son
     */
    public static function getAllFileBackup()
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:raw and format=bk')
                               ->sort_by('version', 'desc')
                               ->max_results(config('configfamily.max_result_cloud'))
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];

        return $links;
    }

    /**
     * @param $file_name
     *
     * @return bool
     * @author hoang_son
     */
    public static function searchFileInCloud($file_name)
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('filename="' . $file_name . '"')
                               ->sort_by('version', 'desc')
                               ->max_results(config('configfamily.max_result_cloud'))
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];
        if (isset($links[0])) {
            return $links[0];
        }

        return false;
    }

    /**
     * @param null $data
     *
     * @throws \Exception
     * @author hoang_son
     */
    public static function downloadLastFileDBInCloud($data_backup = null)
    {
        //<editor-fold desc="Set data backup">
        if ($data_backup == null) {
            $data = self::getAllFileBackup();
            foreach ($data as $value) {
                if (preg_match('/family\.vihoangson\.com_data_family/', $value['filename'])) {
                    $data_backup = $value;
                    break;
                }
            }
        }
        //</editor-fold>

        $m    = file_get_contents($data_backup['url']);
        $path = env('DB_DATABASE');

        // Backup before restore
        // self:self::uploadFileRaw($path,'backup_db');

        if (!file_put_contents($path, $m)) {
            throw new \Exception("Can't save file db");
        } else {
            Log::info('Get db');
        }
    }




}