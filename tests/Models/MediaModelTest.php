<?php

namespace Tests\Model;

use App\Models\Img_cloudinary_model;
use App\Models\Media_model;
use Tests\TestCase;

class MediaModelTest extends TestCase
{


    public function test_hookchatwork()
    {
        $data = [
        'files_path'=>'files_path',
        'files_name'=>'files_name',
        'files_size'=>'files_size',
        'files_type'=>'files_type',
    ];

        Media_model::insert($data);
    }

    public function test_saveCloud()
    {
        $data = [
            'files_path'=>'files_path',
            'files_name'=>'files_name',
            'files_size'=>'files_size',
            'files_type'=>'files_type',
        ];

        Media_model::saveCloud($data);
    }


}
