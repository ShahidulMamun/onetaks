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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->string('link')->nullable();
            $table->string('position')->nullable();
            $table->integer('days');
            $table->decimal('price',10,2)->default(0);
            $table->bigInteger('clicks')->default(0);
            $table->bigInteger('impressions')->default(0);
            $table->enum('status',[
                'pending',
                'approved',
                'expired',
                'rejected'
            ])->default('pending');
            $table->text('rejected_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
