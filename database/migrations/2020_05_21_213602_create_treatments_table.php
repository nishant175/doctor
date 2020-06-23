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
              ->onDelete('cascade')->default(0);
            $table->foreignId('doctor_id')
              ->constrained()
              ->onDelete('cascade')->default(0);
            $table->string('title');
            $table->text('introduction');
            $table->text('cost');
            $table->text('specialization');
            $table->text('faqs');
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
