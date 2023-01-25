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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug',1000)->unique();
            $table->string('description', 1400)->nullable();
            $table->string('regular_price')->nullable();
            $table->string('sell_price')->nullable();
            $table->string('duration')->nullable();
            $table->string('preview')->nullable();
            $table->string('keyword', 1000)->comment('meta information');
            $table->string('thumbnail');
            $table->longText('content');
            $table->float('ratting')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('type')->comment(" 0 => It Consultancy, 1 => Health Consultancy");
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
        Schema::dropIfExists('courses');
    }
};
