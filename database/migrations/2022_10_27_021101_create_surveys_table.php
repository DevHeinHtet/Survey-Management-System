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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('business_type');
            $table->string('owner_name');
            $table->integer('staff_id');
            $table->string('phone_no');
            $table->text('address');
            $table->text('latitude_logitude');
            $table->text('photo');
            $table->longText('staff_remark')->nullable();
            $table->longText('manager_remark')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('surveys');
    }
};
