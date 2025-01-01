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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cetegory_id');
            $table->unsignedBigInteger('type_id');
            $table->string('pcode');
            $table->string('name');
            $table->string('unit');
            $table->string('barcode');
            $table->string('brand_code');
            $table->double('hight_cm');
            $table->double('width_cm');
            $table->double('long_cm');
            $table->integer('tax');
            $table->string('status');
            $table->boolean('added')->nullable();
            $table->boolean('edited')->nullable();
            $table->boolean('deleted')->nullable();
            $table->boolean('confirmed')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
