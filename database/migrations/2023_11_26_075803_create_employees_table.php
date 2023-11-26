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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("name");
            $table->string("email");
            $table->string("image")->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->date("dob")->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('hire_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('status')->nullable(); // active, inactive, on leave, etc.
            $table->unsignedBigInteger('department_id')->nullable(); // foreign key
            $table->unsignedBigInteger('position_id')->nullable();
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

