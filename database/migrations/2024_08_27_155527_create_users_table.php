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
        Schema::create('users', function (Blueprint $table) {
            $table->id('Id');
            $table->unsignedBigInteger('DepartmentPerPosition');
            $table->unsignedBigInteger('EmployeeId');
            $table->unsignedBigInteger('NikNo');
            $table->string('Name');
            $table->string('Email')->unique();
            $table->timestamp('EmailVerifiedAt')->nullable();
            $table->string('Password');
            $table->boolean('Activated');
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
        Schema::dropIfExists('users');
    }
};
