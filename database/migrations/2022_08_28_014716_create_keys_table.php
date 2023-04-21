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
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->text('key')->default('XBX-0000-0000-0000');
            $table->string('value')->nullable();

            $table->integer('auth_requests')->default(0);
            $table->timestamp('claimed_at')->nullable();

            $table->bigInteger('resource_id')->unsigned()->index();
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->bigInteger('owner_id')->unsigned()->index()->nullable();
            $table->foreign('owner_id')->references('id')->on('users');
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
        Schema::dropIfExists('keys');
    }
};
