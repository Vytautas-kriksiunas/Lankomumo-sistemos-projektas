<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('attended_at')->useCurrent();
            $table->unique(['lecture_id', 'user_id']); // studentas negali žymėtis du kartus
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

