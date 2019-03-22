<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRukunWargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rukun_warga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('kelurahan_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('kelurahan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('rukun_warga', function (Blueprint $table) {
        //     $table->dropForeign(['kelurahan_id']);
        // });
        
        Schema::dropIfExists('rukun_warga');
    }
}
