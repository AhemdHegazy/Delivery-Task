<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('role',["user","admin","delivery"]);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('barcode')->nullable();
            $table->enum('status',["new","approved","shipped","outForDelivery","delivered"])->nullable();
            $table->string('tracking_code')->nullable();
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
