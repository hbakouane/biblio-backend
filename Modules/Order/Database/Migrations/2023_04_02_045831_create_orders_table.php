<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Order\Entities\Order;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('customer_id');
            $table->enum('status', Order::getStatuses())
                ->default(Order::STATUS_PENDING);
            $table->float('total')
                ->nullable();
            $table->string('note')
                ->nullable();

            $table->foreign('customer_id')
                ->references('id')
                ->on('profiles');

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
};
