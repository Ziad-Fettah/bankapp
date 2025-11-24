<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('clients', function (Blueprint $table) {
        $table->string('sexe')->after('adresse'); // after adresse column
        $table->date('date_de_naissance')->after('sexe');
    });
}

public function down()
{
    Schema::table('clients', function (Blueprint $table) {
        $table->dropColumn(['sexe', 'date_de_naissance']);
    });
}



};
