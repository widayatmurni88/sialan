<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desk')->nullable();
            $table->string('file_link')->nullable();
            $table->unsignedBigInteger('absen_id');
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
        Schema::dropIfExists('doc_kegiatans');
    }
}
