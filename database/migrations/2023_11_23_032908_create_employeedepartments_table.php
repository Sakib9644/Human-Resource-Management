<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('employeedepartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign keys
         
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_departments');
    }
}
