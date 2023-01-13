<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_projects', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('案件ID');
            $table->string('name')->comment('案件名');
            $table->string('version')->nullable()->comment('案件バージョン');
            $table->tinyInteger('status')->nullable()->default(1)->comment('1:新規、2:着手中、3:ステイ中、4:完了');
            $table->date('start_date')->nullable()->comment('開始日');
            $table->date('end_date')->nullable()->comment('終了日');
            $table->integer('plan_cost')->default(0)->comment('見積工数');
            $table->integer('fix_cost')->default(0)->comment('最終工数');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_projects');
    }
}
