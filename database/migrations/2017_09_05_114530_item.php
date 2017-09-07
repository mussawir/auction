<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Item extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('item_title');
            $table->string('item_type');
            $table->string('item_discription');
            $table->string('main_image');
            $table->string('optional_image');
            $table->string('optional_image2');
            $table->string('optional_image3');
            $table->string('optional_image4');
            $table->string('optional_image5');
            $table->string('delivery_method');
            $table->string('buy_now');
            $table->string('starting_price');            
            $table->string('start_date');
            $table->string('end_date');
            $table->string('cate_id');
            $table->string('status');
            $table->string('campus_name');
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
        //
        Schema::dropIfExists('items');
    }
}
