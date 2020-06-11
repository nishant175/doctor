<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')
              ->constrained()
              ->onDelete('cascade');
            $table->foreignId('doctor_id')
              ->constrained()
              ->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('patient_name');
            $table->string('patient_age', 5);
            $table->string('patient_mobile', 10);
            $table->string('patient_city', 50);
            $table->string('patient_state', 50);
            $table->string('patient_pincode', 10);
            $table->text('patient_address')->nullable();
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
        Schema::dropIfExists('treatments');
    }
}
