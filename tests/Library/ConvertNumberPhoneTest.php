<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/12/2019
 * Time: 1:58 PM
 */

namespace App\Libraries;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Tests\TestCase;

class ConvertNumberPhoneTest extends TestCase {

    public function test_Run() {
        $m = new ConvertNumberPhone();
        $m->setPhone11('01218851144');
        $m->run();
        dd($m->getPhone10());

    }
}
