<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testController()
    {
        //$response = $this->call($method, $uri, $parameters, $cookies, $files, $server, $content);
        $response = $this->call('GET', 'overview');
        $response->assertStatus(200);
        $response->assertJsonStructure();
    }
}
