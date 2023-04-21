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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->boolean('downloadable')->default(true);
            $table->string('lock_type')->default('ipv4');

            $table->longText('server_code')->default('-- SERVER SIDE CODE');

            $table->string('image')->default('https://cdn.discordapp.com/attachments/990678673835294730/1021754001684963338/xw_logo_static.png');
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
        Schema::dropIfExists('resources');
    }
};
