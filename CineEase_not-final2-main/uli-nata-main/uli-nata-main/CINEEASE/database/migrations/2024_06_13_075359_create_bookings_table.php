<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('movie_id')->constrained()->onDelete('cascade');
        $table->string('movie_title');
        $table->string('poster');
        $table->decimal('amount', 8, 2);
        $table->json('seatArrangement')->nullable(); // Ensure it's JSON type for array storage
        $table->integer('seats_booked');
        $table->decimal('total_amount', 8, 2);
        $table->string('payment_method');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}

