<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Ubah tipe kolom yang sudah ada
            $table->decimal('maxWeight', 15, 2)->change();
            $table->decimal('maxVolume', 15, 2)->change();

            // Ubah kolom existing
            $table->decimal('remainingAmount', 15, 2)->default(0)->change();
            $table->decimal('paidAmount', 15, 2)->default(0)->change();
        });

        // Tambahkan kolom baru hanya jika belum ada
        if (!Schema::hasColumn('orders', 'estimationDate')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dateTime('estimationDate')->after('loadingDate');
            });
        }

        if (!Schema::hasColumn('orders', 'container_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('container_id')->after('paymentStatus');
            });
        }

        if (!Schema::hasColumn('orders', 'truck_first_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('truck_first_id')->nullable()->after('container_id');
            });
        }

        if (!Schema::hasColumn('orders', 'truck_second_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('truck_second_id')->nullable()->after('truck_first_id');
            });
        }

        if (!Schema::hasColumn('orders', 'address')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('address')->nullable()->after('truck_second_id');
            });
        }

        // Tambahkan foreign key hanya jika kolomnya sudah ada
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'container_id')) {
                $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            }

            if (Schema::hasColumn('orders', 'truck_first_id')) {
                $table->foreign('truck_first_id')->references('id')->on('trucks')->onDelete('set null');
            }

            if (Schema::hasColumn('orders', 'truck_second_id')) {
                $table->foreign('truck_second_id')->references('id')->on('trucks')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['container_id']);
            $table->dropForeign(['truck_first_id']);
            $table->dropForeign(['truck_second_id']);

            // Drop kolom yang ditambahkan
            $table->dropColumn([
                'estimationDate',
                'container_id',
                'truck_first_id',
                'truck_second_id',
                'address',
            ]);
        });
    }
};
