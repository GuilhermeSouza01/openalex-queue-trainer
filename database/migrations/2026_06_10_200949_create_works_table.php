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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('openalex_id')->unique();
            $table->string('title')->nullable();
            $table->string('doi')->nullable();
            $table->unsignedSmallInteger('publication_year')->nullable();
            $table->boolean('is_open_access')->default(false);
            $table->unsignedBigInteger('cited_by_count')->default(0);
            $table->string('type')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->dateTime('updated_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
