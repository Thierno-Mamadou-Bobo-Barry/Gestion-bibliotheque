<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    protected $fillable = ['nom', 'prenom'];

    public function livres()
{
    return $this->belongsToMany(\App\Models\Livre::class, 'livre_auteur')->withTimestamps();
}

}
