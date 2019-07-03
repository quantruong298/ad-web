<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('user_id');
            $table->integer('status');
            $table->datetime('start_day');
            $table->datetime('end_day');
            $table->integer('budget');
            $table->integer('bid_amount');
            $table->text('description');
            $table->integer('product_id')->nullable();
            $table->text('link');
            $table->text('banner');
            $table->text('file_name');
            $table->integer('type_id')->nullable();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
