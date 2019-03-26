<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRukunTetanggaIdToRukunWargaIdOnTpsCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tps_coverages', function (Blueprint $table) {
            $table->renameColumn('rukun_tetangga_id', 'rukun_warga_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tps_coverages', function (Blueprint $table) {
            $table->renameColumn('rukun_warga_id','rukun_tetangga_id');
        });
    }
}
