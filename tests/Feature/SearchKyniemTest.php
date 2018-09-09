<?php

namespace Tests\Feature;

use App\Libraries\CloudinaryLib;
use Cloudinary\Api;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchKyniemTest extends TestCase
{
    public function test_searchkyniem()
    {
        $user = factory(\App\User::class)->make();
        $response        = $this->actingAs($user)->get('/kyniem/search?keyword=Bố Sơn');
        $response->assertStatus(200);
    }

    public function test_searchkyniem_NG()
    {
        $user = factory(\App\User::class)->make();
        $response        = $this->actingAs($user)->get('/kyniem/search?keyword=B');
        $response->assertStatus(302);
    }
}
