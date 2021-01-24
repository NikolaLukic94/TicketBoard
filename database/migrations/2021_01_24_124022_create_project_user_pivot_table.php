<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // project members
        Schema::create('project_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index();

            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('project_id')->index();

            $table->foreign('project_id')->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->timestamps();

            $table->primary(['user_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_user_pivot');
    }
}
