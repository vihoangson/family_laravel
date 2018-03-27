<?php

namespace App\Models;

use App\Libraries\Markdown;
use Illuminate\Database\Eloquent\Model;

class Kyniem extends Model {

    protected $table   = 'kyniem';
    protected $guarded = [];

    public function getKyniemContentAttribute($value) {
        return Markdown::defaultTransform($value);
    }

    public function getHomepage() {
        return $this->orderBy('id', 'desc')
                    ->limit(10)
                    ->get();
    }

}