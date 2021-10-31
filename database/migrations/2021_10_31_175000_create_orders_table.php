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
            $table->double('total')->default(0);
            $table->string('invoice_no')->nullable();
            $table->string('deliver_to')->nullable();
            $table->enum('status', ['Completed', 'Processing', 'Cancled']);
            $table->boolean('order_type')->default(0);
            $table->foreignId('user_id');
            $table->foreignId('waiter_id');
            $table->foreignId('cacher_id');
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
