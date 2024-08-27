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
        Schema::create('depertment_per_positions', function (Blueprint $table) {
            $table->id("Id");
            $table->unsignedBigInteger("OfficeId");
            $table->unsignedBigInteger("DepartmentId");
            $table->unsignedBigInteger("PositionId");
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
        Schema::dropIfExists('depertment_per_positions');
    }
};
