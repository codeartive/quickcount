<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRukunTetanggaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rukun_tetangga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('rukun_warga_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('rukun_warga_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::create('rukun_tetangga', function (Blueprint $table) {
        //     $table->dropForeign(['rukun_warga_id']);
        // });
        Schema::dropIfExists('rukun_tetangga');
    }
}
