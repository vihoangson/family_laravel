<?php

namespace Tests\Model;

use App\Models\Img_cloudinary_model;
use App\Models\Kyniem;
use App\Models\Media_model;
use App\User;
use Tests\TestCase;

class UserModelTest extends TestCase
{


    public function test_search_kyniem()
    {
        $u = User::find(11);
        $u->avatar;

    }
}
