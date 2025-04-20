<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->text('commodities')->nullable()->change();
            $table->decimal('price', 12, 2)->comment('Per CBM')->change();
            $table->integer('container_id')->after('is_for_customer')->nullable();
            $table->integer('truck_first_id')->nullable()->after('container_id');
            $table->integer('truck_second_id')->nullable()->after('truck_first_id');
        });
    }

    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('commodities')->nullable()->change();
            $table->decimal('price')->change();
            $table->dropColumn(['container_id', 'truck_first_id', 'truck_second_id']);
        });
    }
};

