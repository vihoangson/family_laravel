<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    /**
     * Get all of the posts that are assigned this tag.
     */
    public function kyniems()
    {
        return $this->morphedByMany('App\Models\Kyniem', 'taggable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function videos()
    {
        // todo: add new
        //return $this->morphedByMany('App\Video', 'taggable');
    }
}