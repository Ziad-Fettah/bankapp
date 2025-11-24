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
    Schema::table('accounts', function (Blueprint $table) {
        if (!Schema::hasColumn('accounts', 'type')) {
            $table->string('type')->nullable()->after('rib');
        }
    });
}


public function down()
{
    Schema::table('accounts', function (Blueprint $table) {
        $table->dropColumn('type');
    });
}

};
