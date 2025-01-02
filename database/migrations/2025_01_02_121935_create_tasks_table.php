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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description'); 
            $table->enum('status', ['todo', 'in_progress', 'completed']);
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->date('due_date')->nullable(); 
            $table->unsignedBigInteger('assigned_to')->nullable(); 
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
