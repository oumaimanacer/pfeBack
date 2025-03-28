<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormateursInternesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::create('formateurs_internes', function (Blueprint $table) {
           // $table->id();
            //$table->timestamps();
        //});
        Schema::create('formateurs_internes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('formations', function (Blueprint $table) {
            $table->foreignId('formateur_interne_id')
                  ->nullable()
                  ->constrained('formateurs_internes')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('formateurs_internes');
        Schema::table('formations', function (Blueprint $table) {
            $table->dropForeign(['formateur_interne_id']);
            $table->dropColumn('formateur_interne_id');
        });

        Schema::dropIfExists('formateurs_internes');
    }
}
