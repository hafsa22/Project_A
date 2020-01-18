<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('delivery_dates', function (Blueprint $table) {
                 $table->bigIncrements('id');
                 $table->string('day_name',15);
                 $table->date('date');
                  $table->integer('city_id')->unsigned();
                              $table->foreign('city_id')
                                       ->references('id')->on('cities')
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
        Schema::dropIfExists('delivery_dates');
    }
}
