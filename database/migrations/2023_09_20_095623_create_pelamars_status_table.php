<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelamarsStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelamars_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelamar');
            $table->string('status_pelamar');
            $table->string('lokasi_interview');
            $table->dateTime('jadwal_interview');
            $table->text('keterangan_interview');
            $table->timestamps();

            $table->foreign('id_pelamar')->references('id')->on('pelamars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelamars_status');
    }
}
