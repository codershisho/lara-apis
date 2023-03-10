<?php

namespace App\Models\NuxtSchedule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class MMember extends Model
{
    use SoftDeletes;

    protected $connection = 'nuxt-schedule';

    protected $fillable = [
        'name',
        'image_path'
    ];

    protected $appends = ['image'];


    public function getImageAttribute()
    {
        $image = Storage::get($this->image_path);
        return $image;
    }
}
