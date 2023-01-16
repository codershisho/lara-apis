<?php

namespace App\Models\NuxtSchedule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TProjectMemos extends Model
{
    use SoftDeletes;

    protected $connection = 'nuxt-schedule';

    protected $fillable = [
        'project_id',
        'memo'
    ];
}
