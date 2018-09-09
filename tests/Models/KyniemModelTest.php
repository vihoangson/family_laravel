<?php

namespace Tests\Model;

use App\Models\Img_cloudinary_model;
use App\Models\Kyniem;
use App\Models\Media_model;
use Tests\TestCase;

class KyniemModelTest extends TestCase
{


    public function test_search_kyniem()
    {
        $keyword='kem';
        $m = Kyniem::search($keyword);
        $this->assertGreaterThan(0,$m->count());
        $this->assertInstanceOf(Kyniem::class, $m->first(),$m->count());
    }
}
