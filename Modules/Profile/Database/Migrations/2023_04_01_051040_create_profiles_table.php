<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\User\Entities\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('user_id');

            $table->string('country_id');

            $table->date('dob')
                ->nullable();
            $table->text('note')
                ->nullable();
            $table->text('website')
                ->nullable();

            $table->string('phone_country_id');
            $table->integer('phone_number')
                ->nullable();

            $table->enum('status', User::getStatuses())
                ->default(User::STATUS_ACTIVE);
            $table->dateTime('last_logged_in')
                ->nullable();


            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('country_id')
                ->references('code')
                ->on('countries');
            $table->foreign('phone_country_id')
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
        Schema::dropIfExists('profiles');
    }
};
