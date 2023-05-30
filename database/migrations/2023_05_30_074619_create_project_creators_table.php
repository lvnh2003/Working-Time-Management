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
        Schema::create('project_creators', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idProject');
            $table->unsignedInteger('idCreator');
            $table->foreign('idProject')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idCreator')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_creators');
    }
};
