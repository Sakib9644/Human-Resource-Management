<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('pay_period_start_date');
            $table->date('pay_period_end_date');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('overtime_pay', 10, 2)->nullable();
            $table->decimal('deductions', 10, 2)->nullable();
            $table->decimal('net_salary', 10, 2);
            $table->timestamps();

            // Foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
