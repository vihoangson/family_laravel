<?php

namespace Tests\Feature;

use Cloudinary\Api;
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
        $response->assertStatus(404);
    }

    /**
     * Check connect chatnham
     *
     * @author hoang_son
     */
    public function test_chatnham()
    {
        /** @method \App\Http\Controllers\api\AIController@chatnham */
        $response = $this->post('/api/chatnham');
        $response->assertStatus(200);
    }

    /**
     * Check connect flag deploy
     *
     * @author hoang_son
     */
    public function test_flag_deploy()
    {
        $response = $this->get('/api/flag_deploy');
        $response->assertStatus(200);
    }

    /**
     * Check connect deploy_done
     *
     * @author hoang_son
     */
    public function test_deploy_done()
    {
        $response = $this->get('/api/deploy_done');
        $response->assertStatus(200);
    }

    /**
     * Check gui request thanh cong len url [/api/hookchatwork]
     *
     * @author hoang_son
     */
    public function testPutRequestOK()
    {
        $data                                     = [];
        $data['webhook_event']['room_id']         = 119727315;
        $data['webhook_event']['body']            = 'Gì đó gà';
        $data['webhook_event_type']               = 'mention_to_me';
        $data['webhook_event']['from_account_id'] = 1819944;

        $response = $this->post('/api/hookchatwork', $data);
        $response->assertStatus(200);
    }

    /**
     * * Check gui request khong thanh cong len url [/api/hookchatwork]
     *
     * @author hoang_son
     */
    public function testPutRequestBad()
    {
        $data                                     = [];
        $data['webhook_event']['room_id']         = 1;
        $data['webhook_event']['body']            = 1;
        $data['webhook_event_type']               = 1;
        $data['webhook_event']['from_account_id'] = 1;

        $response = $this->post('/api/hookchatwork', $data);
        $response->assertStatus(404);
    }

    /**
     * Test action bật cờ deploy deploy
     *
     * @author hoang_son
     */
    public function testFlagDeploy()
    {
        $response = $this->get('/api/flag_deploy?option=deploy');
        $response->assertStatus(200);
        $this->assertNotnull(\Cache::get('deploy_frontend'));
        // Tắt ngay sau khi bật
        $this->get('/api/deploy_done');
    }

    /**
     * Test tắt cờ deploy
     *
     * @author hoang_son
     */
    public function testDeployDone()
    {
        $response = $this->get('/api/deploy_done');
        $response->assertStatus(200);
        $this->assertNull(\Cache::get('deploy_frontend'));

    }
}
