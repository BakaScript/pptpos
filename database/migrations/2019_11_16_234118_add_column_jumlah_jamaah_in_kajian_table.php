<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJumlahJamaahInKajianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kajian', function (Blueprint $table) {
            $table->integer('jumlah_jamaah')->after('ustadz') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kajian', function (Blueprint $table) {
            $table->integer('jumlah_jamaah')->after('ustadz') ;
        });
    }
}
