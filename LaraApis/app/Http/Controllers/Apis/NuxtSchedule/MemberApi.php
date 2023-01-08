<?php

namespace App\Http\Controllers\Apis\NuxtSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NuxtSchedule\MMember;

class MemberApi extends Controller
{
    public function index()
    {
        $datas = MMember::all();
        return response()->json(
            $datas
        );
    }

    public function store(Request $req)
    {
        $model = new MMember();
        $model->fill($req->all());
        $model->save();
        return;
    }
}
