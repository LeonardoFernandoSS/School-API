<?php

use App\Enums\DaytimeEnum;
use App\Enums\StatusEnum;
use App\Models\Curriculum;
use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->enum('daytime', Arr::pluck(DaytimeEnum::cases(), 'value'))->default(DaytimeEnum::MORNING);
            $table->foreignIdFor(Teacher::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Curriculum::class)->constrained()->onDelete('cascade');
            $table->enum('status', StatusEnum::toArray())->default(StatusEnum::BLOCK);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
