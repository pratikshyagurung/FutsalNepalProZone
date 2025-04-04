<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFutsalOwnerIdToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'futsal_owner_id')) {
                $table->unsignedBigInteger('futsal_owner_id')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['futsal_owner_id']);
            $table->dropColumn('futsal_owner_id');
        });
    }
}
