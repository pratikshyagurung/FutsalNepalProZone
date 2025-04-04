<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();

            $table->decimal('TotalPrice', 10, 2);
            $table->foreignId('Event_ID')->constrained('events');
            $table->string('Status')->default('pending');
            $table->dateTime('Date');
            $table->foreignId('User_ID')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_bookings');
    }
};
