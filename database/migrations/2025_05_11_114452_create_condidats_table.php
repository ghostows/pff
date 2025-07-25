<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('candidats', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('prenom');
    $table->integer('age');
    $table->string('email')->unique();
    $table->string('cin')->unique();
    $table->string('adresse');
    $table->string('photo');
    $table->string('document');
    $table->string('niveau_scolaire');
    $table->string('formation_type');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condidats');
    }
};
