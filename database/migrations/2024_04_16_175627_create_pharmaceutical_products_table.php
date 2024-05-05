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

            $table->string("product_name", 50);
            $table->date("expiration_date");
            $table->float("price");
            $table->string("description", 500);
            $table->integer("quantity");
            $table->enum("status", ["Active", "Out Of Stock"])->default("Active");

            
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
