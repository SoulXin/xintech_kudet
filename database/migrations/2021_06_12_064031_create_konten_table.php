<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konten', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konten');
            $table->string('banner_konten');
            $table->string('status');
            $table->integer('view')->default('0');
            $table->string('jenis_konten');
            $table->unsignedBigInteger('id_objek');
            $table->foreign('id_objek')
            ->references('id')
            ->on('objek')
            ->onDelete('cascade');
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
        Schema::dropIfExists('konten');
    }
}
