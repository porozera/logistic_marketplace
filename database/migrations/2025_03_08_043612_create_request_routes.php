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
        Schema::create('request_routes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('origin');
            $table->string('destination');
            $table->enum('shipmentMode', ['D2D', 'D2P', 'P2D', 'P2P']);
            $table->enum('shipmentType', ['FCL', 'LCL']);
            $table->enum('transportationMode', ['darat', 'laut']);
            $table->date('arrivalDate');
            $table->date('deadline');
            $table->enum('cargoType', ['General Cargo', 'Special Cargo', 'Dangerous Cargo'])->nullable();
            $table->enum('status', ['active', 'deactive']);
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('container_id')->nullable();
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_routes');
    }
};
