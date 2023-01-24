<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('etat')->default('attente'); // l'etat de la demande par defaut attente ->
            $table->string('objet'); //objet de la demande 
            $table->string('privileges'); 
            $table->unsignedInteger('emetteur_id');
            $table->foreign('emetteur_id')->references('id')->on('user');
            $table->unsignedInteger('recepteur_id');
            $table->foreign('recepteur_id')->references('id')->on('user');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('demandes');
    }
}
