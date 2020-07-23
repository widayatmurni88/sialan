<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id('nid');
            $table->string('nama')->nullable();
            $table->string('tmpt_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->boolean('jkel')->nullable();
            $table->unsignedBigInteger('pangkat_id')->nullable();
            $table->unsignedBigInteger('instansi_id')->nullable();
            $table->string('profil_img')->default('person.png');
            $table->timestamps();

            $table->foreign('pangkat_id')->references('id')->on('ranks')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('instansi_id')->references('id')->on('instansis')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodatas');
    }
}
