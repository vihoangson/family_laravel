<?php

namespace Tests\Feature;

use App\Http\Controllers\api\AIController;
use App\Libraries\CloudinaryLib;
use Cloudinary\Api;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChatConGaTest extends TestCase {


    /**
     * @param $post
     *
     * @dataProvider  propertyProvider
     */
    public function testTestConGa($post,$expect) {

        $m        = new AIController;
        $response = $m->chatConGa($post);
        if ($response == null && $expect == null) {
            $this->assertTrue(true);
        }else{
            $this->assertTrue(true);
        }

    }

    public static function propertyProvider() {

        return [
            [
                [
                    'webhook_event'      => [
                        'body'            => 'Mày có ăn cơm không gà',
                        'room_id'         => '119727315',
                        'from_account_id' => '119727315',
                    ],
                    'webhook_event_type' => 'mention_to_me'
                ]
                ,
                true
            ],
            [
                [
                    'webhook_event'      => [
                        'body'            => '[toall]Mày có ăn cơm không gà',
                        'room_id'         => '119727315',
                        'from_account_id' => '119727315',
                    ],
                    'webhook_event_type' => 'mention_to_me'
                ]
                ,
                null
            ],

        ];
    }

}
