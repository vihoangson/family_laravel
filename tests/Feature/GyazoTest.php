<?php

namespace Tests\Feature;


use Illuminate\Http\Request;

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
    public function testGyazo()
    {
        $data= new Request();
        $data->initialize();
        $response = $this->post('/upload',$data);
        $response->assertStatus(200);
    }
}
