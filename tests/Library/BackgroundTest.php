<?php

namespace Tests\Unit;

use App\Libraries\Backgroud;
use Tests\TestCase;

class BackgroundTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFilter()
    {
        $return = Backgroud::filter('[background=red]Sample Test[/background]');
        $this->assertEquals('<div class="background red">Sample Test</div>', $return);
    }

    public function testErrorFilter()
    {
        $return = Backgroud::filter('Sample Test');
        $this->assertEquals('Sample Test', $return);
    }
}
