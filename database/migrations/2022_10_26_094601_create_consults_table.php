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
        Schema::create('consults', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('company_type')->nullable();
            $table->longText('description')->nullable();
            $table->string('short_desc', 1000)->nullable();
            $table->string('business_address', 1000)->nullable();

            $table->string('transaction_id')->nullable();
            $table->string('type')->comment(" 0 => It Consultancy, 1 => Health Consultancy");
            $table->string('payment_status')->default(1);
            $table->tinyInteger('status')->default(1)->comment('0: Inactive, 1:Active');
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
        Schema::dropIfExists('consults');
    }
};
