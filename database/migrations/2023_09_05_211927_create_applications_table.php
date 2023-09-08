<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('DOB')->comment('date of birth');
            $table->enum('gender',['male','female']);
            $table->string('nationality');
            $table->string('cv');
            $table->date('application_date');
            $table->enum('hr_coordintor_status', ["pending","accepted", "rejected"])->nullable();
            $table->enum('hr_manager_status', ["pending","accepted", "rejected"])->nullable();
            //coorditor by id is the id of the hr manager who process the application
            $table->unsignedBigInteger('coorditor_id')->nullable();
            //manager by id is the id of the hr manager who process the application
            $table->unsignedBigInteger('manager_id')->nullable();
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
        Schema::dropIfExists('applications');
    }
};
