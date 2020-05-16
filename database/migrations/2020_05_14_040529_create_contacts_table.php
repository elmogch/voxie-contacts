<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('team_id');
            $table->string('unsubscribed_status', 191)->default('none');
            $table->string('first_name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('phone', 191);
            $table->string('email', 191)->nullable();
            $table->integer('sticky_phone_number_id')->length(11)->nullable();
            $table->string('twitter_id', 191)->nullable();
            $table->string('fb_messenger_id', 191)->nullable();
            $table->timestamps();
            $table->string('time_zone', 191)->nullable();
            $table->index(['team_id', 'phone'], 'idx_phone_search');
            $table->index('team_id');
            $table->index('first_name');
            $table->index('last_name');
            $table->index('phone');
            $table->index('email');
            $table->index('twitter_id');
            $table->index('fb_messenger_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
