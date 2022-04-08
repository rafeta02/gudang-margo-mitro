<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductProductVariationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_product_variation', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_6390435')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_variation_id');
            $table->foreign('product_variation_id', 'product_variation_id_fk_6390435')->references('id')->on('product_variations')->onDelete('cascade');
        });
    }
}
