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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('openalex_id');
            $table->string('display_name');
            $table->string('subfield_id')->nullable();
            $table->string('subfield_name')->nullable();
            $table->string('field_id')->nullable();
            $table->string('field_name')->nullable();
            $table->string('domain_id')->nullable();
            $table->string('domain_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
