<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(false);
        });

        DB::table('sources')->insert([
            [
                'id' => 1,
                'title' => 'affise'
            ],
            [
                'id' => 2,
                'title' => 'pliri'
            ]
        ]);

        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('source_id')->nullable(false);
            $table->string('offer_id')->nullable(false)->unique();
            $table->string('country')->nullable(true)->default(null);
            $table->string('currency')->nullable(true)->default(null);
            $table->string('advertiser')->nullable(true)->default(null);
            $table->string('os')->nullable(true)->default(null);
            $table->string('status')->nullable(true)->default(null);

            $table->json('payload')->nullable(true)->default(null);

            $table->foreign('source_id')->references('id')->on('sources');

            $table->index('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
        Schema::dropIfExists('sources');
    }
}
