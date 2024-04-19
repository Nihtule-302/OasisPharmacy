<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id("order_id");

            $table->foreignId("customer_id")->constrained();
            $table->foreignId("staff_id")->constrained();
            $table->foreignId("item_id")->constrained();
            
            $table->dateTime('order_date');
            $table->string('delivery_status');
            $table->float('total_price');

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
        Schema::dropIfExists('orders');
    }
}