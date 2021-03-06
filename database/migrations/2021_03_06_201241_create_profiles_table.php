<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');//this will connect the profile table to the user table
            $table->string('title') ->nullable();
            $table->text('description') ->nullable();
            $table->string('url') ->nullable();
            $table->string('image')->nullable();
            $table->timestamps();


            //add index for foreign key
            $table->index('user_id'); //for searchability and quicker queries
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
}
