<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalite extends Model
{
    protected $fillable = ['emprunt_id', 'jours_retard', 'montant', 'payee'];

public function emprunt()
{
    return $this->belongsTo(\App\Models\Emprunt::class);
}

}
