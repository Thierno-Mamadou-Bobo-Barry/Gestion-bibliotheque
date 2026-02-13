<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    protected $fillable = [
    'user_id',
    'livre_id',
    'date_emprunt',
    'date_retour_prevue',
    'date_retour_effective',
    'retourne',
];

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

public function livre()
{
    return $this->belongsTo(\App\Models\Livre::class);
}

public function penalite()
{
    return $this->hasOne(\App\Models\Penalite::class);
}


}
