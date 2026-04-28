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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('account_type'); // bkash, nagad, bank etc
            $table->string('account_no');
            $table->decimal('amount', 10, 2); // user requested amount
            $table->decimal('charge', 10, 2)->default(0); // system charge
            $table->decimal('final_amount', 10, 2)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
