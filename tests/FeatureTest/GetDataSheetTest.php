<?php

namespace Tests\Unit;

use App\Libraries\GetDBSheet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetDataSheetTest extends TestCase
{

    public function testlibgetdbsheet(){
        $spreadsheet_url = "1t5RVjamu-L16f19w27Q-yBCrLtk-sshWevda2ZhlF3U";
        GetDBSheet::setLinkSheet($spreadsheet_url);
        $data = GetDBSheet::getByAssign('Văn Hoài');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $spreadsheet_url = "https://docs.google.com/spreadsheets/d/1t5RVjamu-L16f19w27Q-yBCrLtk-sshWevda2ZhlF3U/export?format=csv&gid=0";
        $data = $this->getdatasheet($spreadsheet_url);
        foreach ($data as $value){
            if($value['Assign']=='Anh Tuấn' && $value['Progress'] == '100%'){
                dump($value);
            }
        }
        $this->assertGreaterThan(1,count($data));
    }

    function getdatasheet($spreadsheet_url){

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
