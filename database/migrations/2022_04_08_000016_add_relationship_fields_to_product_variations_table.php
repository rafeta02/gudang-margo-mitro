<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductVariationsTable extends Migration
{
    public function up()
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->foreign('attribute_id', 'attribute_fk_6351169')->references('id')->on('product_attributes');
        });
    }
}
