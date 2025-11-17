<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'amount',
        'action',
        'type',
    ];

    // From account relationship
    public function fromAccount() {
        return $this->belongsTo(Account::class, 'from_account_id'); // FIXED column name
    }

    // To account relationship
    public function toAccount() {
        return $this->belongsTo(Account::class, 'to_account_id'); // FIXED column name
    }

    public $timestamps = true;
}
