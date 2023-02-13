<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->double('boj')->nullable()->default(0.);
            $table->double('hizmat')->nullable()->default(0.);
            $table->double('kogaz')->nullable()->default(0.);
            $table->timestamps();
        });

        DB::table('services')->insert([
            [
                'id' => 1,
                'name' => 'Бақайдгирии давлатии таваллуд (то яксола)',
                'kogaz' => 11.00,
                'boj' => 0
            ],
            [
                'id' => 2,
                'name' => 'Бақайдгирии давлатии (аз муҳлат гузашта, барқарори) таваллуд  (аз як сола то шонздаҳсола)',
                'kogaz' => 11.00,
                'boj' => 0
            ],
            [
                'id' => 3,
                'name' => 'Бақайдгирии давлатии (аз муҳлат гузашта, барқарори) таваллуд  (аз шонздаҳсола боло)',
                'kogaz' => 11.00,
                'boj' => 0
            ],
            [
                "id" => 4,
                "name" => "Бақайдгирии давлатии вафот (дар давоми як сол)",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 5,
                "name" => "Бақайдгирии давлатии вафот (зиёда аз як сол пеш)",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 6,
                "name" => "Бақайдгирии давлатии ақди никоҳ",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 7,
                "name" => "Бақайдгирии давлатии бекор кардани ақди никоҳ",
                "boj" => 55.00,
                "kogaz" => 11.00
            ], [
                "id" => 8,
                "name" => "Бақайдгирии давлатии фарзандхондӣ",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 9,
                "name" => "Бақайдгирии давлатии муқаррар намудани падарӣ",
                "kogaz" => 0,
                'boj' => 0
            ], [
                "id" => 10,
                "name" => "Бақайдгирии давлатии иваз намудани насаб, ном ва номи падар",
                "boj" => 110.00,
                "kogaz" => 11.00
            ], [
                "id" => 11,
                "name" => "Ворид намудани ислоҳ, тағйирот ва иловаҳо",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 12,
                "name" => "Барқарор кардани сабти асноди ҳолати шаҳрвандӣ",
                "boj" => 55.00,
                "kogaz" => 11.00
            ], [
                "id" => 13,
                "name" => "Бекор кардани сабти асноди ҳолати шаҳрвандӣ",
                "kogaz" => 0,
                'boj' => 0
            ], [
                "id" => 14,
                "name" => "Додани шаҳодатномаи такрорӣ",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 15,
                "name" => "Додани шаҳодатномаҳои нави САҲШ баъди иваз намудани насаб, ном ва номи падар ва (ё) аз кӯдакони ба балоғатнарасида",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 16,
                "name" => "Додани ҳама гуна маълумотномаҳо дар бораи САҲШ, кофтукови ҳуҷчатҳо ва ғ.",
                "kogaz" => 0,
                'boj' => 0
            ], [
                "id" => 17,
                "name" => "Додани шаҳодатномаҳои нави САҲШ баъди ворид намудани ислоҳот, тағйирот ва иловаҳо",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 18,
                "name" => "Додани шаҳодатномаи нави таваллуд бо сабаби муқаррар намудани падарӣ ворид намудани тағйирот",
                "kogaz" => 11.00,
                'boj' => 0
            ], [
                "id" => 19,
                "name" => "Додани шаҳодатномаи нави таваллуд бо сабаби фарзандхондии кудак ворид намудани тағйирот",
                "kogaz" => 11.00,
                'boj' => 0
            ],
        ]);

        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
