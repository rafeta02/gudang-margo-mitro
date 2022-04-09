<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSalesOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->foreign('sales_person_id', 'sales_person_fk_6396071')->references('id')->on('sales_people');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6396072')->references('id')->on('users');
        });
    }
}
