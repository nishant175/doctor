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
            $table->foreignId('hospital_id')
              ->constrained()
              ->onDelete('cascade');
            $table->foreignId('category_id')
              ->constrained()
              ->onDelete('cascade');
            $table->string('name');
            $table->string('designation');
            $table->string('experience');
            $table->string('qualification');
            $table->text('speciality');
            $table->text('about')->nullable();
            $table->text('specialization')->nullable();
            $table->text('list_of_awards')->nullable();
            $table->text('work_experience')->nullable();
            $table->text('education_training')->nullable();
            $table->string('slug')->nullable();
            $table->softDeletes();
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
