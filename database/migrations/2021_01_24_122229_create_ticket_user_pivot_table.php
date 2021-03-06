<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // involved users
        Schema::create('ticket_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index();

            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('ticket_id')->index();

            $table->foreign('ticket_id')->references('id')
                ->on('tickets')
                ->onDelete('cascade');

            $table->boolean('watcher')->default(0);
            $table->boolean('assigned')->default(0);
//            $table->primary(['user_id', 'ticket_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_user_pivot');
    }
}
