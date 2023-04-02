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
            $table->string('description')
                ->nullable();
            $table->string('category');
            $table->enum('status', Book::getStatuses())
                ->default(Book::STATUS_ACTIVE);
            $table->string('published_by');

            $table->foreign('category')
                ->references('category')
                ->on('categories');
            $table->foreign('published_by')
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
        Schema::dropIfExists('books');
    }
};
