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
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('descricao');
            $table->boolean('status')->default(0);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
            $table->timestamp('data_criacao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('data_execucao')->default(DB::raw('CURRENT_TIMESTAMP'));
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
