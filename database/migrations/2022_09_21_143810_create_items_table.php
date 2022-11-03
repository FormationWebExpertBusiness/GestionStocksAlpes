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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->float('price', 8, 2)->default(0);
            $table->string('comment')->nullable();
            $table->integer('rack_level');
            $table->string('serial_number');
            $table->foreignId('rack_id')->constrained('racks')->onUpdate('restrict')->onDelete('cascade');
            $table->foreignId('common_id')->constrained('common_items')->onUpdate('restrict')->onDelete('cascade');

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
        Schema::dropIfExists('items');
    }
};
