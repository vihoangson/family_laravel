<?php

namespace App\Libraries;

Class GetDBSheet
{

    //const spreadsheet_url = '';

    public static $spreadsheet_url = '';



    public static function setLinkSheet($spreadsheet_url){
        self::$spreadsheet_url = $spreadsheet_url;
    }

    public static function getByAssign($assign)
    {
        $return = [];
        $data = self::getdatasheet(self::$spreadsheet_url);
        if($assign == 'all'){
            return $data;
        }

        foreach ($data as $value) {
            if ($value['Assign'] == $assign ) {
                $return []= $value;
            }
        }
        return $return;
    }

    public static function getdatasheet($spreadsheet_url = null)
    {
        if ($spreadsheet_url == null) {
            $spreadsheet_url = "https://docs.google.com/spreadsheets/d/1t5RVjamu-L16f19w27Q-yBCrLtk-sshWevda2ZhlF3U/export?format=csv&gid=0";
        }
        if (!ini_set('default_socket_timeout', 15)) {
            echo "<!-- unable to change socket timeout -->";
        }

        if (($handle = fopen($spreadsheet_url, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $spreadsheet_data[] = $data;
            }
            fclose($handle);

            foreach ($spreadsheet_data[0] as $key => $value) {
                $name_column [] = $value;
            }
            $return = [];
            foreach ($spreadsheet_data as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                foreach ($value as $k => $v) {
                    $return[$key][$name_column[$k]] = $v;
                }
            }


        } else {
            die("Problem reading csv");
        }

        return $return;
    }
}