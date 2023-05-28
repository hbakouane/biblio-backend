<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_books', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('book_id')
                ->nullable();
            $table->string('order_id')
                ->nullable();
            $table->decimal('price')
                ->nullable();
            $table->integer('quantity')
                ->nullable();

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->cascadeOnDelete();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('order_books');
    }
};
