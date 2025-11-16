<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'emetteur_id',
        'recepteur_id',
        'montant'
    ];

    public function emetteur()
    {
        return $this->belongsTo(Account::class, 'emetteur_id');
    }

    public function recepteur()
    {
        return $this->belongsTo(Account::class, 'recepteur_id');
    }
}
