<?php

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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('event_type_id')->constrained('event_types')->cascadeOnDelete();
            $table->string('name');
            $table->longText('description');
            $table->string('faculty', 50)->nullable();
            $table->string('major', 50)->nullable();
            $table->string('instance', 50)->nullable()->default('Universitas Udayana');
            $table->string('picture');
            $table->enum('location', ['online', 'offline']);
            $table->decimal('price', 10, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
