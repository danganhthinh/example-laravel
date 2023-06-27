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
            $table->string('code')->unique()->nullable();
            $table->string('display_name')->nullable();
            $table->string('kana_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('figure')->nullable();
            $table->string('height')->nullable();
            $table->string('pre_pregnancy_weight')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('first_registration_date')->nullable();
            $table->time('initial_registration_time')->nullable();
            $table->string('role')->default(\App\Models\User::ROLE_STUDENT);
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
