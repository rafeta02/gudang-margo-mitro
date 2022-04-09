<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitySalesPersonPivotTable extends Migration
{
    public function up()
    {
        Schema::create('city_sales_person', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_person_id');
            $table->foreign('sales_person_id', 'sales_person_id_fk_6392455')->references('id')->on('sales_people')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id', 'city_id_fk_6392455')->references('id')->on('cities')->onDelete('cascade');
        });
    }
}
