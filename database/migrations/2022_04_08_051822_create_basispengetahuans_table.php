<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasispengetahuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basispengetahuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyakit_id')->nullable();
            $table->foreign('penyakit_id')->references('id')->on('penyakits');

            $table->unsignedBigInteger('gejala_id')->nullable();
            $table->foreign('gejala_id')->references('id')->on('gejalas');

            $table->double('bobot');
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
        Schema::dropIfExists('basispengetahuans');
    }
}
