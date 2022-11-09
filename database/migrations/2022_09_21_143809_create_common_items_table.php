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
        Schema::create('common_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(1);
            $table->unsignedBigInteger('brand_id')->default(1);
            $table->string('model');
            $table->integer('quantity_warning')->default(10);
            $table->integer('quantity_urgent')->default(5);
            $table->boolean('favorite')->default(false);
            $table->string('photo_item')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('restrict')->onDelete('cascade');
        
            $table->timestamps();
            $table->unique(['model', 'brand_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('common_items');
    }
};
