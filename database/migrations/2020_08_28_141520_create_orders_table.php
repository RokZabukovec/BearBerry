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
            $table->id();
            $table->string('status')->default('processing');
            $table->timestamps();
        });

        Schema::create('item_order', function (Blueprint $table) {
            $table->id();
            $table->biginteger('item_id')->nullable()->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('quantity')->default(1);
            $table->biginteger('order_id')->nullable()->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('orders');
    }
}
