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
            $table->string('receiverName');
            $table->string('receiverTelpNumber');
            $table->text('description');
            $table->text('destinationAddress')->nullable();
            $table->string('originAddress')->nullable();
            $table->string('invoiceNumber')->unique();
            $table->decimal('totalPrice',15, 2);
            $table->string('paymentStatus');
            $table->dateTime('RTL_start_date')->nullable();
            $table->dateTime('RTL_end_date')->nullable();
            $table->string('snap_token')->nullable();
            $table->uuid('payment_token')->unique()->nullable();
            $table->timestamp('expires_at')->nullable();
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
