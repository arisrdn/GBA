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
        Schema::create('reading_group_members', function (Blueprint $table) {
            $table->id();
            $table->string('readingperday')->nullable();
            $table->string('approved_ad')->nullable();
            $table->string('reason_leave')->nullable();
            $table->string('leave_at')->nullable();
            $table->foreignId('reading_group_id');
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
        Schema::dropIfExists('reading_group_members');
    }
};
