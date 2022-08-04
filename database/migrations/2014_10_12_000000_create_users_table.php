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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('whatsapp_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('photo_profile')->nullable();
            
            
            $table->foreignId('country_id')->nullable();
            $table->foreignId('church_branch_id')->nullable();
            $table->foreignId('role_id')->default(2);
            
            $table->string('device_token')->nullable();
            // $table->string('device_name')->nullable();
            

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
