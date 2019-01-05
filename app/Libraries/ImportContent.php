<?php

namespace App\Libraries;

use App\Models\Kyniem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

Class ImportContent {

    /**
     * ImportContent constructor.
     */
    public function __construct() {

    }

    public function run() {
        if (false) {
            unlink(env('DB_DATABASE'));
            CloudinaryLib::downloadLastFileDBInCloud();
        }

        try {
            $db     = $this->GetDBSheet();
            $string = ("'" . implode("','", array_column($db, 'date')) . "'");
            foreach ($db as $value) {
                if (Kyniem::whereRaw('strftime("%Y-%m-%d",`kyniem_create`) in (\'' . $value['date'] . '\') and kyniem_title = "' . $value['title'] . '"')
                          ->count() == 0) {
                    $kn                 = new Kyniem;
                    $kn->kyniem_title   = $value['title'];
                    $kn->kyniem_content = $value['content'];
                    $kn->kyniem_create  = $value['date'];
                    $kn->kyniem_modifie = $value['date'];
                    $kn->save();
                    Cache::flush();
                }
            }
            CommonLib::alert_to_me('Imported content from sheet: Success');
        } catch (\Exception $e) {
            CommonLib::alert_to_me('Imported content from sheet: Error');
        }

    }

    private function GetDBSheet() {
        return GetDBSheet::getdatasheet(config('configfamily.idSheetImport'));
    }

}