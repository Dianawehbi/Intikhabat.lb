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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade'); // The candidate being voted for
            $table->foreignId('electoral_district_id')->constrained()->onDelete('cascade'); // The district where vote was cast
            $table->foreignId('election_id')->constrained()->onDelete('cascade'); // The election this vote belongs to
            $table->foreignId('voter_id')->nullable()->constrained('users')->onDelete('set null'); // Voter ID, if you track users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
