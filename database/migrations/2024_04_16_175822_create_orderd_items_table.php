<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderd_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId("product_id")->constrained()->onDelete('cascade');
            $table->foreignId("order_id")->constrained()->onDelete('cascade');
            $table->integer("quantity");
            
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
        Schema::dropIfExists('orderd_items');
    }
}
