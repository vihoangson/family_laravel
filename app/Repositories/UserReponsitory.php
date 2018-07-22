<?php

namespace App\Repositories;

use App\Models\Kyniem;

class UserReponsitory {

    public function __construct() {
    }

    /**
     * @return mixed
     */
    public function get_all_ky_niem() {
        return Kyniem::all();
    }
}
