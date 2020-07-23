<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bio_nid');
            $table->unsignedBigInteger('pangkat_id');
            $table->timestamp('tgl_absen');
            $table->foreign('bio_nid')->references('nid')->on('biodatas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('pangkat_id')->references('id')->on('ranks')->onUpdate('cascade')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absens');
    }
}
