<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaceuticalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmaceutical_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId("product_id")->constrained();
            $table->string("product_name", 50);
            $table->date("expiration_date");
            $table->integer("price");
            $table->string("description", 500);
            
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
        Schema::dropIfExists('pharmaceutical_products');
    }
}
