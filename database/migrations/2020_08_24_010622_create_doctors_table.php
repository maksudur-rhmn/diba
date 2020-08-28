<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('doctors_image');
            $table->longText('speciality');
            $table->longText('academic_details');
            $table->longText('chamber_details');
            $table->string('visiting_hours');
            $table->longText('designation');
            $table->longText('experience');
            $table->string('doctors_email');
            $table->string('for_appointment');
            $table->integer('category_id');
            $table->integer('city_id');
            $table->integer('featured_listing')->default(0);
            $table->integer('out_of_office')->default(1);
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
        Schema::dropIfExists('doctors');
    }
}
