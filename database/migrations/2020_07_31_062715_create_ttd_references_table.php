<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTtdReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttd_references', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->unsignedBigInteger('instansi_id');
            $table->unsignedBigInteger('bio_nid');
            $table->foreign('instansi_id')->references('id')->on('instansis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bio_nid')->references('nid')->on('biodatas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ttd_references');
    }
}
