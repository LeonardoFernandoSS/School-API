<?php

use App\Models\Classroom;
use App\Models\Enrollment;
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
        Schema::create('classroom_enrollment', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classroom::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Enrollment::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_curriculum');
    }
};
