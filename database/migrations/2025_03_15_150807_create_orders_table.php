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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('noOffer')->unique();
            $table->string('lspName');
            $table->string('origin');
            $table->string('destination');
            $table->enum('shipmentMode', ['laut', 'darat']);
            $table->enum('shipmentType', ['FCL', 'LCL']);
            $table->dateTime('loadingDate');
            $table->dateTime('shippingDate');
            $table->dateTime('estimationDate');
            $table->integer('maxWeight');
            $table->integer('maxVolume');
            $table->integer('remainingWeight')->nullable();
            $table->integer('remainingVolume')->nullable();
            $table->text('commodities')->nullable();
            $table->string('status')->nullable();
            $table->decimal('price', 15, 2);
            $table->decimal('totalAmount', 15, 2);
            $table->decimal('remainingAmount', 15, 2);
            $table->decimal('paidAmount', 15, 2);
            $table->string('paymentStatus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
