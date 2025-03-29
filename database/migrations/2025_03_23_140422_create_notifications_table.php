<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id'); // ID user pembuat notifikasi
            $table->unsignedBigInteger('receiver_id'); // ID user penerima notifikasi
            $table->string('header');
            $table->text('description');
            $table->string('status');
            $table->timestamps();

            // Relasi ke tabel users
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

