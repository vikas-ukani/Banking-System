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
            $table->bigInteger('user_id')->nullable(false)->unique()->unsigned();
            $table->float('balance', 8, 2)->nullable(false)->default(0);
            $table->string('customer_id')->nullable(false)->unique();
            $table->string('address1')->nullable(false);
            $table->string('address2')->nullable();
            $table->string('city')->nullable(false);
            $table->string('state')->nullable(false);
            $table->string('zip')->nullable(false);
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
