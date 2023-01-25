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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('slug', 500);
            $table->string('keywords', 500);
            $table->string('location');
            $table->string('company_name');
            $table->string('position');
            $table->string('job_type');
            $table->string('salary');
            $table->string('experience', 500);
            $table->string('qualification', 500);
            $table->string('image');
            $table->longText('description');
            $table->integer('no_of_vacancy');
            $table->string('type')->comment('1 => It Consultancy, 0 => Health Consultancy');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('jobs');
    }
};
