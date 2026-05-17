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
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['deposit','withdraw','earning','withdraw_charge','refund','jobpost_charge','jobpost_payment','bannerads_payment','tob_job_charge','boost_job_charge']);
            $table->decimal('amount', 10, 4)->default(0);
            $table->string('description')->nullable();
            $table->string('reference_id')->nullable(); 
            $table->enum('status', ['success', 'failed'])
                  ->default('success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_transactions');
    }
};
