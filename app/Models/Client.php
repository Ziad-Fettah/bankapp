<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    use HasFactory;
    protected $fillable = [
    'nom',
    'prenom',
    'sexe',                // add this
    'date_de_naissance',   // add this
    'phone',
    'adresse',
    'email',
    'password',
];

    public function accounts() {
        return $this->hasMany(Account::class);
    }
}
