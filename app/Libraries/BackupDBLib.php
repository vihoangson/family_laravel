<?php

namespace App\Libraries;

class BackupDBLib
{

    public static function backupToCloud()
    {
        try{
            $new_file = 'data_family.' . date("Y-m-d_H_i_s") . '.bk';
            copy(base_path('sqlite/data_family'), base_path('sqlite/' . $new_file));
            CloudinaryLib::uploadFileRaw(base_path('sqlite/' . $new_file), 'backup_db');
            unlink(base_path('sqlite/' . $new_file));
        }catch (\Exception $e){
            return false;
        }
        return true;

    }
}