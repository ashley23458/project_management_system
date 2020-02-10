<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('invite_token')->unique();
            $table->boolean('status')-> nullable();
            $table->unsignedBigInteger('inviter_id');
            $table->foreign('inviter_id')->references('id')->on('users');
            $table->unsignedBigInteger('invitee_id');
            $table->foreign('invitee_id')->references('id')->on('users');
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
        Schema::dropIfExists('invites');
    }
}
