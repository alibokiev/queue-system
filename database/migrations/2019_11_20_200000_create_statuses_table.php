<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('color');
            $table->timestamps();
        });

        DB::table('statuses')->insert([
            [
                'name' => 'pending',
                'display_name' => 'В Очереди',
                'color' => 'warning',
            ],
            [
                'name' => 'active',
                'display_name' => 'Обслуживается',
                'color' => 'success',
            ],
            [
                'name' => 'done',
                'display_name' => 'Готово',
                'color' => 'primary',
            ],
            [
                'name' => 'skipped',
                'display_name' => 'Пропуск',
                'color' => 'danger',
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
        Schema::dropIfExists('statuses');
    }
}
