<?php

use App\Enums\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('electoral_districts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // (Bhanin, Tripoli)
            $table->enum('region', array_column(Region::cases(),'value'));
            $table->integer('seats_available')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electoral_districts');
    }
};
