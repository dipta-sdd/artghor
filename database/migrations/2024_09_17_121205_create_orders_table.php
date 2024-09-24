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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('delevery_fee', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->string('bkash_no')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('area')->nullable();
            $table->text('address')->nullable();
            $table->timestamp('delevery_time')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
