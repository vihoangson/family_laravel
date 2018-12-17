<?php

namespace Tests\Unit;

use App\Libraries\Backgroud;
use App\Libraries\CloudinaryLib;
use Tests\TestCase;

class CloudinaryLibTest extends TestCase {

    public function test_uploadImg() {
        CloudinaryLib::uploadImg(public_path("/assets/Library/Background/img/candy.jpg"),'testing');
    }

    /**
     * Function dufng ddeer upload tất cả file trên cloud chưa có
     */
    public function test_uploadAllImgInStorage() {
        CloudinaryLib::uploadAllImgInStorage();
    }

    /**
     * Upload file raw lên cloud
     */
    public function test_uploadFileRaw() {
        CloudinaryLib::uploadFileRaw(base_path("sqlite/data_family"),'testing');
    }

    /**
     * Get all file in cloud
     */
    public function test_getAllImage() {

        $rs = (CloudinaryLib::getAllImage());
        $this->assertNotFalse($rs);
    }

    /**
     * Lấy hình trong folder chỉ định
     */
    public function test_getImageInFolder() {
        $rs = CloudinaryLib::getImageInFolder('testing');
        $this->assertNotFalse($rs);
    }

    /**
     * Lấy toàn bộ file raw trong cloud
     */
    public function test_getAllRaw() {
        $rs = CloudinaryLib::getAllRaw();
        $this->assertNotFalse($rs);
    }

    /**
     * Lấy toàn bộ file db backup trong cloud
     */
    public function test_getAllFileBackup() {
        $rs = CloudinaryLib::getAllFileBackup();

        $this->assertNotFalse($rs);
    }

    /**
     * Tìm tên file trong cloud
     */
    public function test_searchFileInCloud() {
        $rs = CloudinaryLib::searchFileInCloud('candy.jpg');
        $this->assertNotFalse($rs);
    }

    public function test_downloadLastFileDBInCloud() {
        // Check nếu không có file db thì lên cloud lấy file db mới nhất về
        if (!file_exists(env('DB_DATABASE'))) {
            CloudinaryLib::downloadLastFileDBInCloud();
        }else{
        }
    }
}
