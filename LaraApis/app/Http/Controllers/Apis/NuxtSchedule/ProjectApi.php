<?php

namespace App\Http\Controllers\Apis\NuxtSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\NuxtSchedule\MProject;
use Exception;

class ProjectApi extends Controller
{
    public function index()
    {
        $datas = MProject::all();
        return response()->json(
            $datas
        );
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();

            $model = new MProject();
            $model->fill($req->all());
            $model->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json([
            'message' => '登録完了しました'
        ]);
    }

    public function update($id, Request $req)
    {
        try {
            DB::beginTransaction();
            $model = MProject::find($id);
            if(!$model) {
                throw new Exception("対象データが存在しません。処理を終了しました。");
            }

            $model->fill($req->all());
            $model->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return response()->json([
            'message' => '更新完了しました'
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            MProject::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json([
            'message' => '削除完了しました'
        ]);
    }
}
