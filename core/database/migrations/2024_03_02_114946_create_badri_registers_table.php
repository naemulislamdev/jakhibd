<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadriRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badri_registers', function (Blueprint $table) {
            $table->id();
            $table->string('badri_type_id');
            $table->string('name');
            $table->string('phone');
            $table->string('register_date')->nullable();
            $table->string('rosit_no')->nullable();
            $table->longText('address')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('badri_registers');
    }
}
