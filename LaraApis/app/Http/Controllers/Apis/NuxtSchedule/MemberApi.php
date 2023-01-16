<?php

namespace App\Http\Controllers\Apis\NuxtSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\NuxtSchedule\MMember;
use Exception;

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
        try {
            $cn = DB::connection('nuxt-schedule');
            $cn->beginTransaction();

            $model = new MMember();
            $model->name = $req->name;

            $dir = 'user';
            // アップロードされたファイル名を取得
            $file_name = $req->name . '.svg';
            $req->file('image')->storeAs('public/' . $dir, $file_name);

            $model->image_path = 'public/' . $dir . '/' . $file_name;

            $model->save();
            $cn->commit();
        } catch (\Throwable $th) {
            $cn->rollBack();
            throw $th;
        }

        return response()->json([
            'message' => '登録完了しました'
        ]);
    }

    public function update($id, Request $req)
    {
        try {
            $cn = DB::connection('nuxt-schedule');
            $cn->beginTransaction();

            $model = MMember::find($id);
            if(!$model) {
                throw new Exception("対象データが存在しません。処理を終了しました。");
            }

            $model->name = $req->name;
            $model->save();

            $cn->commit();
        } catch (\Throwable $th) {
            $cn->rollback();
            throw $th;
        }

        return response()->json([
            'message' => '更新完了しました'
        ]);
    }

    public function delete($id)
    {
        try {
            $cn = DB::connection('nuxt-schedule');
            $cn->beginTransaction();

            MMember::find($id)->delete();

            $cn->commit();
        } catch (\Throwable $th) {
            $cn->rollBack();
            throw $th;
        }

        return response()->json([
            'message' => '削除完了しました'
        ]);
    }
}
