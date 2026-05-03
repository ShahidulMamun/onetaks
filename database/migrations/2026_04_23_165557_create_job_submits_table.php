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
        Schema::create('job_submits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job_posts')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('job_owner_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('proof_text')->nullable(); 
            $table->string('proof_image')->nullable();  
            $table->string('submitted_code')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');
            $table->text('reject_reason')->nullable();
            // Prevent duplicate submission (optional but recommended)
            $table->unique(['job_id', 'user_id']);
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->index('user_id');
            $table->index('job_id');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_submits');
    }
};
