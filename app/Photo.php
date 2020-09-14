<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name',
        'owner_id',
        'photo_url',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'id',
            'photo_url');
    }
}
