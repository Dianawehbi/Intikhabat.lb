<?php

use App\Enums\Position;
use App\Enums\Sect;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->enum('sect', array_column(Sect::cases(), 'value'));
            $table->enum('position', array_column(Position::cases(), 'value'))->default('عضو مجلس بلدي');
            $table->foreignId('list_model_id')->constrained()->onDelete('cascade');
            $table->foreignId('electoral_district_id')->constrained()->onDelete('cascade');
            $table->boolean('won')->default(false);
            $table->integer('votes_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
