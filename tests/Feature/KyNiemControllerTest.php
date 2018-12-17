<?php

namespace Tests\Feature;

use App\Models\Kyniem;
use Cloudinary\Api;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KyNiemControllerTest extends TestCase
{


    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_getkyniem()
    {
        $user            = factory(\App\User::class)->make();
        $request['step'] = 1;
        $response        = $this->actingAs($user)
                                ->get('/api/getkyniem', $request);
        $response->assertStatus(200);
    }

    public function test_deletekyniem()
    {
        $id       = 505;
        $response = $this->get('/kyniem/delete?id=' . $id);
        $response->assertStatus(302);

        // restore delete flg
        $m = new Kyniem;
        $m->find($id)
          ->update(['delete_flg' => 0]);
    }

    public function test_checkdomain()
    {
        $s = file_get_contents('https://whois.inet.vn/api/whois/domainspecify/asalight.vn');
    }

    public function test_createKyniem()
    {
        $user            = factory(\App\User::class)->make();
        $request = [
            '_token'=> csrf_token(),
            'content' => 'Testing create content',
            'title'   => 'Testing create title',
        ];
        $response        = $this->actingAs($user)
                                ->post(route('kyniem_store'), $request);

        $response->assertStatus(302,$response->content());
    }
}
