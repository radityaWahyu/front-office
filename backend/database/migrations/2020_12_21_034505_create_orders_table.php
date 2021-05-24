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
            $table->uuid('id')->primary();
            $table->string('order_code');
            $table->uuid('customer_id');
            $table->uuid('departement_id');
            $table->uuid('item_id');
            $table->string('description_order');
            $table->double('payment');
            $table->double('total');
            $table->enum('status',['order','process','finish','pending','cancel']);
            $table->string('description_status');
            $table->date('finished_at');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('restrict');
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
