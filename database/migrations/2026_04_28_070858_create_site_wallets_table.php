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
        Schema::create('site_wallets', function (Blueprint $table) {
            $table->id();
            $table->decimal('lifetime_profit', 12, 2)->default(0);
            $table->decimal('lifetime_deposit', 12, 2)->default(0);
            $table->decimal('lifetime_withdraw', 12, 2)->default(0);
            $table->decimal('withdraw_charge', 12, 2)->default(0);
            $table->decimal('jobpost_charge', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_wallets');
    }
};
