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
        Schema::create('event_bws', function (Blueprint $table) {
   $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->dateTime('start_date');
        $table->dateTime('end_date');
        $table->string('place');
        $table->decimal('price', 10, 2)->default(0);
        $table->boolean('is_free')->default(false);
        $table->integer('capacity')->nullable();
        $table->string('image')->nullable();
        $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
        $table->foreignId('category_id')->constrained('category_bws')->onDelete('cascade');
        $table->foreignId('created_by')->constrained('users_bw')->onDelete('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event__bws');
    }
};
