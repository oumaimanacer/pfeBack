<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom_entreprise');
            $table->string('secteur_activite')->nullable();
            $table->string('adresse');
            $table->string('numero_de_telephone')->nullable();
            $table->integer('nombre_employes');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();

        });
    }

    public function down() {
        Schema::dropIfExists('entreprises');
    }
}
