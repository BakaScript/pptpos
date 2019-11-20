<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kajian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tempat') ;
            $table->string('tema') ;
            $table->string('ustadz') ;
            $table->date('tanggal_kajian') ;
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
        Schema::dropIfExists('kajian');
    }
}
