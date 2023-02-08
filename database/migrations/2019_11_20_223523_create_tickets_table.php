<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->text('comment')->nullable();

            $table->integer('category_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('user_id')->nullable()->unsigned();

            $table->timestamp('created_at');
            $table->timestamp('invited_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
