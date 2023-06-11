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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("account_name")->nullable(false);
            $table->string("frequency", 50)->nullable();
            $table->string("last_recon_month", 50)->nullable();
            $table->string("status", 50)->nullable();
            $table->string("pending" , 50)->nullable();
            $table->string("monthly_instructions")->nullable();
            $table->string("month_id", 50)->nullable(false);
            $table->string("comment1")->nullable();
            $table->string("comment2")->nullable();
            $table->string("comment3")->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable(false);
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('accounts');
    }
};
