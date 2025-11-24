<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
    $table->id(); // ID auto-increment
    $table->string('rib')->unique(); // RIB
    $table->decimal('solde', 10, 2)->default(0); // Solde
    $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // belongs to a client
    $table->string('type')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
