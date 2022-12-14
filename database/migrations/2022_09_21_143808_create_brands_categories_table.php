<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->primary(['brand_id', 'category_id']);

            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('restrict')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands_categories');
    }
};
