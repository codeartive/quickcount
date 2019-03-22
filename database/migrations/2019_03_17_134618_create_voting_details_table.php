<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('voting_id');
            $table->unsignedInteger('calon_legislatif_id');
            $table->integer('value');
            $table->index('voting_id');
            $table->index('calon_legislatif_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('voting_details', function (Blueprint $table) {
        //     $table->dropForeign(['voting_id']);
        //     $table->dropForeign(['calon_legislatif_id']);
        // });
        Schema::dropIfExists('voting_details');
    }
}
