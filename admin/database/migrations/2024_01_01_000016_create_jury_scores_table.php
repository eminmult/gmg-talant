<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jury_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jury_member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('video_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('skill');
            $table->unsignedTinyInteger('originality');
            $table->unsignedTinyInteger('presentation');
            $table->unsignedTinyInteger('uniqueness');
            $table->unsignedTinyInteger('impact');
            $table->decimal('average', 4, 2);
            $table->timestamps();

            $table->unique(['jury_member_id', 'video_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jury_scores');
    }
};
