<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('list_models', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // List name (e.g., "Development and Reform")
            $table->foreignId('party_id')->nullable()->constrained()->onDelete('set null'); // can be independent 
            $table->foreignId('electoral_district_id')->constrained()->onDelete('cascade'); //  Tripoli, Bhanin
            $table->foreignId('election_id')->constrained()->onDelete('cascade'); // بلدية / انتخابية + السنة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_models');
    }
};
