<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author_first_name');
            $table->string('author_last_name');
            $table->string('initials', 5);
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('department')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->string('video_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
