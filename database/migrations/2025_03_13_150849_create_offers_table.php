<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('truck_first_id')->nullable();
            $table->unsignedBigInteger('truck_second_id')->nullable();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->string('noOffer')->unique();
            $table->string('origin');
            $table->string('destination');
            $table->string('portOrigin')->nullable();
            $table->string('portDestination')->nullable();
            $table->enum('shipmentMode', ['D2D', 'D2P', 'P2D', 'P2P']);
            $table->enum('transportationMode', ['darat', 'laut']);
            $table->enum('shipmentType', ['FCL', 'LCL']);
            $table->dateTime('pickupDate')->nullable();
            $table->dateTime('departureDate')->nullable();
            $table->dateTime('cyClosingDate')->nullable();
            $table->dateTime('etd');
            $table->dateTime('eta');
            $table->dateTime('deliveryDate')->nullable();
            $table->dateTime('arrivalDate');
            $table->integer('maxWeight');
            $table->integer('maxVolume');
            $table->integer('remainingWeight')->nullable();
            $table->integer('remainingVolume')->nullable();
            $table->enum('cargoType', ['General Cargo', 'Special Cargo', 'Dangerous Cargo'])->nullable();
            $table->enum('status', ['active', 'deactive']);
            $table->decimal('price', 15, 2);
            $table->boolean('is_for_lsp')->default(true);
            $table->boolean('is_for_customer')->default(true);
            $table->foreign('truck_first_id')->references('id')->on('trucks')->onDelete('cascade');
            $table->foreign('truck_second_id')->references('id')->on('trucks')->onDelete('cascade');
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
