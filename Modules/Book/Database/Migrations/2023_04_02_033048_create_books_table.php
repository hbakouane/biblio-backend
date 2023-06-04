<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Book\Entities\Book;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('title')
                ->nullable();
            $table->string('excerpt')
                ->nullable();
            $table->string('author')
                ->nullable();
            $table->longText('description')
                ->nullable();
            $table->string('category_id');
            $table->decimal('price')
                ->nullable();
            $table->integer('quantity')
                ->nullable();
            $table->enum('status', Book::getStatuses())
                ->default(Book::STATUS_PUBLISHED);
            $table->string('published_by');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();

            $table->foreign('published_by')
                ->references('id')
                ->on('profiles')
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
        Schema::dropIfExists('books');
    }
};
