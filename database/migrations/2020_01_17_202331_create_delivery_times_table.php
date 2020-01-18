<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_times', function (Blueprint $table) {
                  $table->bigIncrements('id');
                  $table->string('delivery_at');
                  $table->timestamps();
                   $table->integer('delivery_date_id')->unsigned();
                              $table->foreign('delivery_date_id')
                                    ->references('id')->on('delivery_dates')
                                     ->onDelete('cascade');

              });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_times');
    }
}
