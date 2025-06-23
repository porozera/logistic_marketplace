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
        Schema::create('user_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userOrder_id')->nullable();
            $table->foreign('userOrder_id')->references('id')->on('user_orders')->onDelete('cascade');
            $table->decimal('volume', 15,3)->default(1);
            $table->decimal('weight', 15, 3)->default(1);
            $table->decimal('length', 15, 3)->default(1);
            $table->decimal('height', 15, 3)->default(1);
            $table->decimal('width', 15, 3)->default(1);
            $table->decimal('price', 15, 3)->default(1);
            $table->integer('qty')->default(1);
            $table->string('commodities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_order_items');
    }
};
