<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('tps_id');
            $table->text('photo');
            $table->index('tps_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('voting', function (Blueprint $table) {
        //     $table->dropForeign(['tps_id']);
        // });
        
        Schema::dropIfExists('voting');
    }
}
