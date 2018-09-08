<?php

namespace Tests\Admin;

use Cloudinary\Api;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminControllerTest extends TestCase
{


    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_access_admin_options()
    {
        $user = factory(\App\User::class)->make();

        $response = $this->actingAs($user)
                         ->get('/admin/options');
        $response->assertStatus(200);
    }

    public function test_entity_options()
    {
        $options = factory(\App\Models\Options::class)->make();
        $this->assertInstanceOf(\App\Models\Options::class, $options);
    }


}
