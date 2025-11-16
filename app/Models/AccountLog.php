<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class AccountLog extends Model
{
    protected $fillable = [
        'account_id',
        'action'
    ];

    public function account()
{
    return $this->belongsTo(Account::class);
}
}
