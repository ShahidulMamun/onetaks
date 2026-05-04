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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('continent_id')->constrained('continents')->restrictOnDelete();
            $table->foreignId('country_id')->constrained('countries')->restrictOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->foreignId('subcategory_id')->constrained('sub_categories')->restrictOnDelete();
            $table->string('title');
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->integer('worker_need')->default(0);
            $table->integer('worker_done')->default(0);
            $table->integer('worker_remaining')->default(0);
            $table->decimal('budget', 12, 2)->default(0);
            $table->decimal('worker_earn', 10, 2)->default(0);
            $table->integer('max_reject')->default(0);
            $table->integer('reject_done')->default(0);
            $table->boolean('has_secret_code')->default(false);
            $table->string('secret_code')->nullable();
            $table->json('proofs'); // [{type: 'text'|'image', label: '...'}]
            $table->enum('status', ['pending','pause','reject','active','complete',])->default('pending');
            $table->string('reject_reason')->nullable();
            $table->boolean('is_top')->default(false);
            $table->integer('top_order')->nullable();
            $table->timestamp('topped_at')->nullable();
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
        Schema::dropIfExists('job_posts');
    }
};
