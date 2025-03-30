<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('plateNumber')->unique();
            $table->string('type'); // Tipe truk yang bisa angkut kontainer
            $table->string('brand');
            $table->integer('yearBuilt');
            $table->string('driverName');
            $table->string('driverContact');
            $table->string('color');
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trucks');
    }
};
