<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_todolists', function (Blueprint $table) {
            $table->id();
            $table->string('read_at')->nullable();
            $table->string('schedule');
            $table->foreignId('group_todolist_id');
            $table->foreignId('group_member_id');
            // $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('member_todolists');
    }
};
