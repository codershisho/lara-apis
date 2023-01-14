<?php

namespace App\Http\Controllers\Apis\NuxtSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\NuxtSchedule\MProject;
use App\Models\NuxtSchedule\TProjectMember;
use Exception;

class ProjectApi extends Controller
{
    public function index()
    {
        $datas = MProject::with(['members','members.member'])->get();

        $datas = $datas->map(function($project) {
            $members = [];

            $mem = $project->members;
            $members = $mem->map(function($member) {
                return [
                    'id' => $member->member->id,
                    'name' => $member->member->name,
                    'image' => $member->member->image
                ];
            });
            $project['fix_members']=$members;
            return $project;
        });

        return response()->json(
            $datas
        );
    }

    public function store(Request $req)
    {
        try {
            $cn = DB::connection('nuxt-schedule');
            $cn->beginTransaction();

            $model = new MProject();
            $model->fill($req->all());
            $model->save();
            $projectId = $model->id;

            $members = collect($req->members);
            $members->each(function($memberId) use($projectId) {
                $m = new TProjectMember();
                $m->project_id = $projectId;
                $m->member_id = $memberId;
                $m->save();
            });

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
            $model = MProject::find($id);
            if(!$model) {
                throw new Exception("対象データが存在しません。処理を終了しました。");
            }

            $model->fill($req->all());
            $model->save();

            $members = collect($req->members);
            TProjectMember::where('project_id', $id)->delete();
            $members->each(function($memberId) use($id) {
                $m = new TProjectMember();
                $m->project_id = $id;
                $m->member_id = $memberId;
                $m->save();
            });

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
            MProject::find($id)->delete();
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
