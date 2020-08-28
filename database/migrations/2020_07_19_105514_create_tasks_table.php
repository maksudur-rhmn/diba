<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('tasks');
            $table->longText('task_description');
            $table->string('roles')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('deadline');
            $table->enum('status',['upcoming', 'in progress', 'completed'])->default('upcoming');
            $table->enum('is_notified', ['seen', 'unseen'])->default('unseen');
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
        Schema::dropIfExists('tasks');
    }
}
