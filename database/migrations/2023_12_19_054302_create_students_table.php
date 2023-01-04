<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('grade');
            $table->string('add_num');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('pick_up')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->nullOnDelete();
            $table->foreign('parent_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('trip_id')->references('id')->on('trips')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
