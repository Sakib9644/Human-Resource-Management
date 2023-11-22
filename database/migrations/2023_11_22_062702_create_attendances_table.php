<?php

// database/migrations/xxxx_xx_xx_create_attendances_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('attendance_date');
            $table->time('clock_in_time');
            $table->time('clock_out_time')->nullable();
            $table->enum('status', ['present', 'absent', 'late', 'etc.']);
            $table->timestamps();

            // Define foreign key constraint
         
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
