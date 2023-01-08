<?php

namespace App\Http\Controllers\Apis\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MMember;

class SampleApi extends Controller
{
    public function index()
    {
        $datas = MMember::all();
        return $datas;
    }

    public function store(Request $req)
    {
        $model = new MMember();
        $model->fill($req->all());
        $model->save();
        return;
    }
}
