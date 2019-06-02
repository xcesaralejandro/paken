<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('buy_date');
            $table->date('arrival_date');
            $table->string('state',15);
            $table->string('tracking_number',25)        ->nullable();
            $table->string('store',25);
            $table->string('seller',25)                 ->nullable();
            $table->string('notes',255)                 ->nullable();
            $table->integer('user_id')                  ->unsigned();
            $table->integer('payment_methods_id')       ->unsigned();
            $table->timestamps();

            /*FOREIGN KEY*/
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_methods_id')->references('id')->on('payment_methods');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
