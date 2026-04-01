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
    Schema::table('transaksis', function (Blueprint $table) {
        $table->decimal('subtotal', 10, 2)->after('berat')->default(0);
        $table->decimal('diskon', 10, 2)->after('subtotal')->default(0);
    });
}

public function down()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropColumn(['subtotal', 'diskon']);
    });
}
};
