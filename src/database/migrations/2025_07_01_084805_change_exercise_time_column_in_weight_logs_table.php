<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExerciseTimeColumnInWeightLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->time('exercise_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->integer('exercise_time')->nullable()->change();
        });
    }
}
