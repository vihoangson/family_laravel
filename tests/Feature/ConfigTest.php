<?php

namespace Tests\Feature;

use Cloudinary\Api;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConfigTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_hookchatwork()
    {
        $expect = env('SECRET-API') != '';
        $this->assertTrue($expect);
    }

}
