<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timeline_phases', function (Blueprint $table) {
            $table->id();
            $table->string('title_az');
            $table->string('title_en');
            $table->string('date_label');
            $table->date('actual_date')->nullable();
            $table->text('description_az')->nullable();
            $table->text('description_en')->nullable();
            $table->enum('status', ['done', 'active', 'upcoming'])->default('upcoming');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timeline_phases');
    }
};
