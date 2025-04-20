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
            $table->enum('shipmentMode', ['D2D', 'D2P', 'P2D', 'P2P']);
            $table->enum('shipmentType', ['FCL', 'LCL']);
            $table->date('loadingDate');
            $table->date('shippingDate');
            $table->date('estimationDate');
            $table->integer('maxWeight');
            $table->integer('maxVolume');
            $table->integer('remainingWeight')->nullable();
            $table->integer('remainingVolume')->nullable();
            $table->text('commodities')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['Loading Item', 'On The Way', 'Finished'])->nullable();
            $table->decimal('price', 15, 2);
            $table->decimal('totalAmount', 15, 2);
            $table->decimal('remainingAmount', 15, 2);
            $table->decimal('paidAmount', 15, 2);
            $table->enum('paymentStatus', ['Lunas', 'Belum Lunas'])->nullable();
            $table->unsignedBigInteger('lsp_id');
            $table->foreign('lsp_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('truck_first_id')->nullable();
            $table->unsignedBigInteger('truck_second_id')->nullable();
            $table->foreign('truck_first_id')->references('id')->on('trucks')->onDelete('cascade');
            $table->foreign('truck_second_id')->references('id')->on('trucks')->onDelete('cascade');
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
