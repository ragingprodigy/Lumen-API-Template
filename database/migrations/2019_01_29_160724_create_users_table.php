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
        Schema::create(\DevProject\Eloquent\Models\User::TABLE_NAME, function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 50);
            $table->string('username', 20);
            $table->string('email', 100);
            $table->string('password', 128);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);

            $table->dateTimeTz('last_login')->nullable();
            $table->ipAddress('last_login_from')->nullable();

            $table->timestampsTz();
            $table->primary('id');
            $table->index('username');
            $table->index('name');
            $table->index('email');
            $table->index('is_active');
            $table->index('is_admin');
            $table->index('last_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\DevProject\Eloquent\Models\User::TABLE_NAME);
    }
}
