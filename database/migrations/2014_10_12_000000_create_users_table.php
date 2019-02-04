<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->nullable()->default('');
            $table->string('company_name')->nullable()->default('');
            $table->string('email')->nullable()->default('');
            $table->enum('status', ['active', 'in-active'])->nullable()->default('in-active');
            $table->string('password');
            $table->string('type')->nullable()->default('');
            $table->integer('language_id')->unsigned()->default('1000');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
