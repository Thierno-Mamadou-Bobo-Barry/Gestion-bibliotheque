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
    Schema::create('livre_auteur', function (Blueprint $table) {
        $table->id();
        $table->foreignId('livre_id')->constrained('livres')->cascadeOnDelete();
        $table->foreignId('auteur_id')->constrained('auteurs')->cascadeOnDelete();
        $table->timestamps();

        $table->unique(['livre_id', 'auteur_id']);
    });
}

public function down(): void
{
    Schema::dropIfExists('livre_auteur');
}

};
