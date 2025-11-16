<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Account;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Create 3 clients and a linked account for each
        Client::factory()->count(3)->create()->each(function ($c) {
    $rib = '812' . str_pad(random_int(0, 99999999999), 11, '0', STR_PAD_LEFT);
    
    Account::create([
        'rib' => $rib,
        'solde' => 1000,
        'client_id' => $c->id,
    ]);
});
    }
}
