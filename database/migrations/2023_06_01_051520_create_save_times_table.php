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
        Schema::create('save_times', function (Blueprint $table) {
            $table->id();
            $table->integer('hour');
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('idWork');
            $table->foreign('idWork')->references('id')->on('project_creators')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_times');
    }
};
