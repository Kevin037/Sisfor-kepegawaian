<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->string('tgl');
            $table->foreignId('user_id');
            $table->string('masuk')->nullable();
            $table->string('keluar')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('izin_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('is_approve')->nullable();
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
        Schema::dropIfExists('absensis');
    }
}
