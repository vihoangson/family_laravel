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
        $request['step'] = 1;
        $response        = $this->get('/api/getkyniem', $request);
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
        if (json_decode($s, true)['expirationDate'] == '27-07-2018') {

        }

    }
}
