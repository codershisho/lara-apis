<?php

namespace App\Models\NuxtSchedule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TProjectMember extends Model
{
    use SoftDeletes;

    protected $connection = 'nuxt-schedule';

    protected $fillable = [
        'name',
        'image_path'
    ];

    public function member()
    {
        return $this->hasOne('App\Models\NuxtSchedule\MMember', 'id', 'member_id');
    }

    public function project()
    {
        return $this->hasOne('App\Models\NuxtSchedule\MProject', 'id', 'project_id');
    }
}
