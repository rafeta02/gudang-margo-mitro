<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSalesOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('sales_order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_order_id')->nullable();
            $table->foreign('sales_order_id', 'sales_order_fk_6396092')->references('id')->on('sales_orders');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_6396093')->references('id')->on('products');
        });
    }
}
