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
    Schema::create('penalites', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->foreignId('emprunt_id')->constrained('emprunts')->cascadeOnDelete();
        $table->integer('jours_retard');
        $table->integer('montant'); // en GNF par ex
        $table->boolean('payee')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalites');
    }
};
