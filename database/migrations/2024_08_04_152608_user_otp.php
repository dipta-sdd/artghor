<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('otp_sms', 6)->nullable();
            $table->string('otp_email', 6)->nullable();
            $table->timestamp('otp_exp_sms')->nullable();
            $table->timestamp('otp_exp_email')->nullable();
        });
    }

    public function down()
    {
    }
};
