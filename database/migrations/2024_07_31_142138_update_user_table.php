<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('role')->default('user');
            $table->unsignedBigInteger('referd_from')->nullable()->after('username');
            $table->foreign('referd_from')->references('id')->on('users')->onDelete('set null');
        });
    }


    public function down()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
