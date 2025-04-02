<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('noOffer')->unique();
            $table->string('lspName');
            $table->string('origin');
            $table->string('destination');
            $table->enum('shipmentMode', ['D2D', 'D2P', 'P2D', 'P2P']);
            $table->enum('shipmentType', ['FCL', 'LCL']);
            $table->dateTime('loadingDate');
            $table->dateTime('shippingDate');
            $table->dateTime('estimationDate');
            $table->integer('maxWeight');
            $table->integer('maxVolume');
            $table->integer('remainingWeight')->nullable();
            $table->integer('remainingVolume')->nullable();
            $table->text('commodities')->nullable();
            $table->enum('status', ['active', 'deactive']);
            $table->decimal('price', 15, 2);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('timestamp');
            $table->boolean('is_for_lsp')->default(true);
            $table->boolean('is_for_customer')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
