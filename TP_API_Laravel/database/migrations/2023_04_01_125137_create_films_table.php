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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->year('release_year');
            $table->integer('length');
            $table->text('description');
            $table->string('rating', 5);
            $table->foreignId('language_id')->constrained();
            $table->string('special_features', 200);
            $table->string('image', 40);
            $table->timestamps();
            $table->timestamp('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
