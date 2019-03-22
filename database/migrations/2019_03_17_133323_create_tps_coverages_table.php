<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpsCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tps_coverages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('tps_id');
            $table->unsignedInteger('rukun_tetangga_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('tps_id');
            $table->index('rukun_tetangga_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tps_coverages');
    }
}
