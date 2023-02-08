<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default("");
            $table->string('second_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone')->unique();
            $table->integer('tin')->nullable();
            $table->string('passport')->nullable();
            $table->text('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->timestamps();
        });

        DB::table('clients')->insert([
            [
                'id' => 1,
                'name' => 'Старые клиенты',
                'phone' => '992900000000',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
