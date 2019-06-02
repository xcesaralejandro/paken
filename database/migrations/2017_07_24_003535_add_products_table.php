<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',140);
            $table->string('brand',25)              ->nullable();
            $table->string('model',25)              ->nullable();
            $table->string('size',10)               ->nullable();
            $table->string('colour',25)             ->nullable();
            $table->string('material',25)           ->nullable();
            $table->string('url_product',255)       ->nullable();
            $table->double('unit_price',7,2);
            $table->integer('quantity');
            $table->double('shipping_cost',7,2);
            $table->string('sku',25)                ->nullable();
            $table->enum('estado',['new','used'])   ->default('new');
            $table->integer('order_id')             ->unsigned();
            $table->timestamps();

            /*FOREIGN KEY*/
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
