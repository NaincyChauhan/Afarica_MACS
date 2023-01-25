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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogcategory_id');
            $table->string('title', 1000)->comment('meta information');
            $table->string('slug', 1000)->comment('meta information');
            $table->string('desc', 10000)->comment('meta information');
            $table->string('keyword', 1000)->comment('meta information');
            $table->string('tags', 1000)->nullable()->comment('meta information');
            $table->string('image');
            $table->longText('content');
            $table->bigInteger('views')->default(0)->comment('Total Views');
            $table->bigInteger('b_shares')->default(0)->comment('Total Shares');
            $table->bigInteger('comments')->default(0)->comment('Total Comments');
            $table->timestamps();

            //creating foreign key CONSTRAINTS
            $table->foreign('blogcategory_id')->references('id')->on('blogcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
