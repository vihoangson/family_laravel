<?php

namespace Tests\Feature;

use Cloudinary\Api;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FamilyTreeControllerTest extends TestCase {

    public function test_family_tree() {
        $response = $this->get(route('family-tree-index'));
        $response->assertStatus(302);
    }

}
