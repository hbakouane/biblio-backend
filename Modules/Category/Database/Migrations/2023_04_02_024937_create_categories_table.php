<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Category\Entities\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('category')
                ->index()
                ->unique()
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->enum('status', Category::getStatuses())
                ->default(Category::STATUS_ACTIVE);
            $table->string('created_by')
                ->nullable();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

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
        Schema::dropIfExists('categories');
    }
};
