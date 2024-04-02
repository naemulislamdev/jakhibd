<?php

use App\Models\Department;
use App\Models\SubDepartment;
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
            $table->string("name")->nullable();
            $table->foreignIdFor(Department::class)->constrained();
            $table->integer('roll')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('student_nid')->nullable();
            $table->string('birth_reg_no')->nullable();
            $table->string('admision_date')->nullable();
            $table->string('blood')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_nid')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('talimul_name')->nullable();
            $table->string('talimul_nid')->nullable();
            $table->string('talimul_phone')->nullable();
            $table->string('absent_guardian')->nullable();
            $table->string('absent_guardian_nid')->nullable();
            $table->string('absent_guardian_phone')->nullable();
            $table->string('image')->nullable();
            $table->longText('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('session_year')->nullable();
            $table->timestamps();
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
