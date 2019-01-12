<?php

namespace App\Libraries;

class BackupDBLib {

    public static function backupToCloud($file = null) {
        if ($file == null) {
            $file = env('DB_DATABASE');
        }

        try {
            if (preg_match("/:\/\//", env('APP_URL'))) {
                $url_page = explode("//", env('APP_URL'))[1];
            } else {
                $url_page = env('APP_URL');
            }

            $new_file = $url_page . '_data_family.' . date("Y-m-d__H_i_s") . '.bk';

            copy(($file), base_path('sqlite/' . $new_file));
            if (file_exists(base_path('sqlite/' . $new_file))) {
                CloudinaryLib::uploadFileRaw(base_path('sqlite/' . $new_file), 'backup_db');
                unlink(base_path('sqlite/' . $new_file));
            } else {
                CommonLib::alert_to_me('Không tồn tại file');
            }
        } catch (\Exception $e) {
            CommonLib::alert_to_me('Error: ' . $e->getMessage());

            return false;
        }

        return true;

    }
}