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

            $table->string('customer');
            $table->enum('status', Order::getStatuses())
                ->default(Order::STATUS_PENDING);
            $table->string('total')
                ->nullable();
            $table->string('note')
                ->nullable();

            $table->foreign('customer')
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
