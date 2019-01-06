<?php

namespace Tests\Unit;

use App\Libraries\Backgroud;
use App\Libraries\GetDBSheet;
use Tests\TestCase;

class DBSheetTest extends TestCase {

    public function testGetdatasheet() {
        $db = (GetDBSheet::getdatasheet('19lhTfGq6-SQwwul5t8TGi_zg_o9w_mEYjKyABqYTrs0'));
        $this->assertTrue(is_array($db));
    }

}
