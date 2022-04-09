<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('integer');
            $table->decimal('price', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
