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
        Schema::create('objets', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->string('unite');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('marque_id');
            $table->string('reference');
            $table->string('commentaire');
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('marque_id')->references('id')->on('marques')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects');
    }
};
