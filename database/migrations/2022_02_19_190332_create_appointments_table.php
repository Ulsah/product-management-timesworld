<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor')->constrained('users');
            $table->bigInteger('booked_by')->nullable();
            $table->enum('usertype', ['Registered', 'Guest'])->default('Guest');
            $table->string('name');
            $table->string('email');
            $table->date('date');
            $table->time('time');
            $table->string('reason')->nullable();
            $table->string('token')->nullable();
            $table->enum('status', ['Requested', 'Confirmed', 'Declined', 'Completed'])->default('Requested');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
