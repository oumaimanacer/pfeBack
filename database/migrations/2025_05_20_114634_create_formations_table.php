<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('titre'); // Titre de la formation
            $table->text('description')->nullable(); // Description détaillée (peut être NULL)
            $table->date('date_debut'); // Date de début
            $table->date('date_fin'); // Date de fin
            $table->string('heure'); // ✅ Heure de la formation
            $table->integer('nbr_place')->default(0); // Nombre de places disponibles
            $table->string('type'); // 
            $table->string('formateur'); // Formateur de la formation
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
        Schema::dropIfExists('formations');
    }
}
