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
        Schema::create('group_members', function (Blueprint $table) {
            $table->id();
            $table->string('complete_at')->nullable();
            $table->string('approved_at')->nullable();
            $table->string('note')->nullable();
            $table->string('leave_at')->nullable();
            $table->enum('transfer', [true, false])->nullable();
            $table->foreignId('reason_leave_id')->nullable();
            $table->foreignId('group_id');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('group_members');
    }
};
