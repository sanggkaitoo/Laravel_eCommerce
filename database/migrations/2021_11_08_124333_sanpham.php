<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nhomsanphamid')->unsigned();
            $table->string('ten', 100);
            $table->text('mota')->nullable();
            $table->decimal('gia',15,3);
            $table->decimal('giaban',15,3)->nullable();
            $table->string('anh', 255)->nullable();
            $table->string('danhsachanh', 255)->nullable();
            $table->tinyInteger('trangthai')->default(1)->comment('1-public, 0-private');
            $table->tinyInteger('uutien')->default(0)->comment('Thu tu uu tien');
            $table->timestamps();
            $table->foreign('nhomsanphamid')->references('id')->on('nhomsanpham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanpham');
    }
}
