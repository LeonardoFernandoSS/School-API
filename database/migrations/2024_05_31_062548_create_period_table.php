<?php

use App\Enums\PeriodsEnum;
use App\Enums\StatusEnum;
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
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->enum('value', Arr::pluck(PeriodsEnum::cases(), 'value'))->default(PeriodsEnum::MONTHLY);
            $table->enum('status', StatusEnum::toArray())->default(StatusEnum::BLOCK);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
