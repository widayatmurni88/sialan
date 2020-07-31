<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_tjs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bio_nid');
            $table->unsignedBigInteger('instansi_id');
            $table->date('periode');
            $table->timestamps();

            $table->foreign('bio_nid')->references('nid')->on('biodatas');
            $table->foreign('instansi_id')->references('id')->on('instansis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_tjs');
    }
}
