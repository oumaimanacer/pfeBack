<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('nom'); // Nom de l'utilisateur
            $table->string('prenom'); // Prénom de l'utilisateur
            $table->string('email')->unique(); // Email unique
            $table->string('password'); // Mot de passe hashé
            $table->enum('role', ['SuperAdmin', 'Admin', 'Employe','Responsable RH','Formateur_interne','Formateur_externe']); // Rôle de l'utilisateur
            $table->string('poste')->nullable(); // Poste de l'utilisateur
            $table->date('dateEmbauche')->nullable(); // Date d'embauche
            $table->string('entreprise')->nullable(); // Entreprise de l'utilisateur
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
