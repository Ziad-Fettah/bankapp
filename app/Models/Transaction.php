<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Specify the correct table
    protected $table = 'transactions';

    // Fields that can be mass-assigned
    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'amount',
        'action',
        'type', // optional, if you track deposit/transfer/withdraw
    ];

    public $timestamps = true; // created_at / updated_at
}
