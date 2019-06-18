<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientPrescriptionPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_prescription_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_prescription_id');
            $table->foreign('patient_prescription_id')->references('id')->on('patient_prescriptions');
            $table->unsignedBigInteger('pharmacist_id');
            $table->foreign('pharmacist_id')->references('id')->on('users');
            $table->timestamp('purchased_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('patient_prescription_purchases');
    }
}
