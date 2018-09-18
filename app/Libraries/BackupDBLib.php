<?php

namespace App\Libraries;

class BackupDBLib {

    public static function backupToCloud($file = null) {
        if ($file == null) {
            $file = env('DB_DATABASE');
        }

        try {
            $new_file = 'data_family.' . date("Y-m-d__H_i_s") . '.bk';
            copy(($file), base_path('sqlite/' . $new_file));
            if(file_exists(base_path('sqlite/' . $new_file))){
                CloudinaryLib::uploadFileRaw(base_path('sqlite/' . $new_file), 'backup_db');
                unlink(base_path('sqlite/' . $new_file));
            }else{
                CommonLib::alert_to_me('Không tồn tại file');
            }
        } catch (\Exception $e) {
            CommonLib::alert_to_me('Error: '.$e->getMessage());

            return false;
        }

        return true;

    }
}