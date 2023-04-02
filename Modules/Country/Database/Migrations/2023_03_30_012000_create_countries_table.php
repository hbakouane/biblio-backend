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
        Schema::create('countries', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('code')
                ->index()
                ->unique()
                ->nullable();
            $table->string('short_name')
                ->nullable();
            $table->string('full_name')
                ->nullable();
            $table->integer('calling_code')
                ->nullable();
            $table->string('capital')
                ->nullable();
            $table->string('currency')
                ->nullable();
            $table->string('citizenship')
                ->nullable();
            $table->string('flag')
                ->nullable();

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
        Schema::dropIfExists('countries');
    }
};
