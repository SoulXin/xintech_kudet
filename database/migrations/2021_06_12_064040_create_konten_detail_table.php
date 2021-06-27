<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontenDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konten_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konten')->nullable();
            $table->foreign('id_konten')
            ->references('id')
            ->on('konten')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->tinyInteger('jenis'); // => 0 adalah tulisan, 1 adalah gambar, 2 adalah vidio
            $table->text('isi');
            $table->boolean('sementara')->default(0);
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
        Schema::dropIfExists('konten_detail');
    }
}
