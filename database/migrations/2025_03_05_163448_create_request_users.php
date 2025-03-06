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
        Schema::create('request_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('companyName');
            $table->string('permitNumber')->unique();
            $table->string('email')->unique();
            $table->string('telpNumber');
            $table->text('address');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_users');
    }
};
