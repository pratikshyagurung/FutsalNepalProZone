<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('court_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Court_ID')->constrained('courts')->onDelete('cascade');
            $table->foreignId('User_ID')->constrained('users')->onDelete('cascade');
            $table->decimal('TotalPrice', 10, 2);
            $table->enum('Status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamp('Date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
