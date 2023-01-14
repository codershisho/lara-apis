<?php

namespace App\Models\NuxtSchedule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MProject extends Model
{
    use SoftDeletes;

    protected $connection = 'nuxt-schedule';

    protected $fillable = [
        'name',
        'version',
        'status',
        'start_date',
        'end_date',
        'plan_cost',
        'fix_cost',
    ];

    protected $appends = ['status_name'];

    // #####################################
    // relation
    // #####################################
    public function members()
    {
        return $this->hasMany('App\Models\NuxtSchedule\TProjectMember', 'project_id', 'id');
    }

    // #####################################
    // acceser
    // #####################################
    public function getStatusNameAttribute()
    {
        $result = '';
        $v = $this->status;

        switch ($v) {
            case 1:
                $result = '新規';
                break;
            case 2:
                $result = '着手中';
                break;
            case 3:
                $result = 'ステイ中';
                break;
            default:
                $result = '完了';
                break;
        }

        return $result;
    }
}
