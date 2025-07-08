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
        Schema::create('id_scans', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('extracted_date');
            $table->boolean('matched');
            $table->timestamp('uploaded_at');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps(); // <-- Add this line
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('id_scans');
    }
};
