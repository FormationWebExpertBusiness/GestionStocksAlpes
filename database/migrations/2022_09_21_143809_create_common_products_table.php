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
        Schema::create('common_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(1);
            $table->unsignedBigInteger('brand_id')->default(1);
            $table->string('model');
            $table->integer('quantity_low')->default(-1);
            $table->integer('quantity_critical')->default(-1);
            $table->boolean('favorite')->default(false);
            $table->string('photo_product')->nullable();
            $table->string('status_quantity')->default('Quantité critique');
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
        Schema::dropIfExists('common_products');
    }
};
