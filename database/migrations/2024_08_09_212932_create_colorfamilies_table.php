<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('colorfamilies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('color_family');
            $table->string('color_code')->nullable();
            $table->integer('quantity');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('colorfamilies');
    }
};
