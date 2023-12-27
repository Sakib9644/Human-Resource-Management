<?php

// database/migrations/xxxx_xx_xx_create_leaverequests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaverequestsTable extends Migration
{
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('employee_name'); // Add employee name column
            $table->string('employee_email'); // Add employee email column
            $table->enum('leave_type', ['sick_leave', 'vacation', 'other']);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->text('reason');
            $table->timestamps();

            // Define foreign key constraint
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}
