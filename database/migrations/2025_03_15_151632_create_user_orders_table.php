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
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('username');
            $table->string('telpNumber');
            $table->text('description');
            $table->decimal('totalPrice',15, 2);
            $table->string('paymentStatus');
            $table->integer('weight');
            $table->integer('volume');
            $table->string('commodities');
            $table->text('services')->nullable();
            $table->string('snap_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_orders');
    }
};
