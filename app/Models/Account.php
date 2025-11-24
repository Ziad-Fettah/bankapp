<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'rib',
        'solde',
        'client_id',
        'type',
        'status'
    ];

    public function client()
{
    return $this->belongsTo(Client::class);
}

    public function logs()
{
    return $this->hasMany(AccountLog::class);
}


    public function outgoing(){ return $this->hasMany(Transaction::class,'from_account_id'); }
    public function incoming(){ return $this->hasMany(Transaction::class,'to_account_id'); }
}

