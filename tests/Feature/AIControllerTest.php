<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AIControllerTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_hookchatwork()
    {
        $response = $this->post('/api/hookchatwork');
        $response->assertStatus(200);
    }

    public function test_chatnham()
    {
        $response = $this->post('/api/chatnham');
        $response->assertStatus(200);
    }

    public function test_flag_deploy()
    {
        $response = $this->get('/api/flag_deploy');
        $response->assertStatus(200);
    }

    public function test_deploy_done()
    {
        $response = $this->get('/api/deploy_done');
        $response->assertStatus(200);
    }


    public function testPutRequestOK(){
        $data=[];
        $data['webhook_event']['room_id']= 119727315;
        $data['webhook_event']['body']= 1;
        $data['webhook_event_type']= 'mention_to_me';
        $data['webhook_event']['from_account_id']= 1819944;

        $response = $this->post('/api/hookchatwork',$data);
        $response->assertStatus(200);
    }

    public function testPutRequestBad(){
        $data=[];
        $data['webhook_event']['room_id']= 1;
        $data['webhook_event']['body']= 1;
        $data['webhook_event_type']= 1;
        $data['webhook_event']['from_account_id']= 1;

        $response = $this->post('/api/hookchatwork',$data);
        $response->assertStatus(404);
    }
}
