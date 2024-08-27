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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id("Id");
            $table->unsignedBigInteger("DepartmentPerPositionId");
            $table->boolean('Added')->nullable();
            $table->boolean('Edited')->nullable();
            $table->boolean('Deleted')->nullable();
            $table->boolean('Viewed')->nullable();
            $table->string('CreatedBy');
            $table->string('UpdatedBy');
            $table->string('DeletedBy');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
