<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $fillable = [
    'titre',
    'isbn',
    'annee_publication',
    'quantite_totale',
    'quantite_disponible',
    'disponible',
];

public function categorie()
{
    return $this->belongsTo(\App\Models\Categorie::class);
}

public function auteurs()
{
    return $this->belongsToMany(\App\Models\Auteur::class, 'livre_auteur')->withTimestamps();
}

public function emprunts()
{
    return $this->hasMany(\App\Models\Emprunt::class);
}


}


