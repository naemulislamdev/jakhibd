<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_logs', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('department_id');
            $table->string('roll');
            $table->string('total_marks')->nullable();
            $table->string('gpa')->nullable();
            $table->string('year')->nullable();
            $table->string('created_by')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_logs');
    }
}
