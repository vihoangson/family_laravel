<?php
/**
 * Created by PhpStorm.
 * User: hoang_son
 * Date: 1/10/2019
 * Time: 9:11 AM
 */

namespace App\Libraries;

use Tests\TestCase;

class SmsLibTest extends TestCase {

    public function testGetMoney() {
        $m = new SmsLib();
        $rs = $m->getMoney();
        $this->assertNotNull($rs["Balance"]);
        $this->assertNotNull($rs["CodeResponse"]);
        $this->assertNotNull($rs["UserID"]);
    }


    public function testGetMoneyShowing() {
        $m = new SmsLib();
        $rs = $m->getMoney();
        dump($rs["Balance"]);
    }


    public function testSentNG_lower20() {
        $m = new SmsLib();

        try {
            $m->sent(env('MY_PHONE_NUMBER'), 'test_sms');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testSentOK() {
        $m = new SmsLib();
        $m->sent(env('MY_PHONE_NUMBER'),'Bố Sơn về chơi với Kem');
    }

    public function testSentMe() {
        $m = new SmsLib();
        $m->sentMe('Bố Sơn về chơi với Kem');
    }
}
