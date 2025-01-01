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
        Schema::table('products', function (Blueprint $table) {
            $table->string('barcode')->nullable()->change();
            $table->string('hight_cm')->nullable()->change();
            $table->string('width_cm')->nullable()->change();
            $table->string('long_cm')->nullable()->change();
            $table->dropColumn('cetegory_id');
            $table->unsignedBigInteger('category_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
