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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->uuidMorphs('owner');

            $table->string('address_line_1')
                ->nullable();
            $table->string('address_line_2')
                ->nullable();
            $table->string('state')
                ->nullable();
            $table->string('city')
                ->nullable();
            $table->string('zip')
                ->nullable();
            $table->string('country_id')
                ->nullable();


            $table->foreign('country_id')
                ->references('code')
                ->on('countries');

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
        Schema::dropIfExists('addresses');
    }
};
