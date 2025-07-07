<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Sect;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('electoral_district_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('electoral_district_id')->constrained()->onDelete('cascade');
            $table->enum('sect', array_column(Sect::cases(), 'value'));
            $table->integer('seat_count'); // Number of seats for this sect
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electoral_district_seats');
    }
};
