<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',25)->notnull()->default('');
            $table->string('sku',50)->notnull()->default('');
            $table->string('price',10)->notnull()->default('');
            $table->string('color',6)->notnull()->default('');
            $table->string('image',255)->notnull()->default('');
            $table->string('thumb',255)->notnull()->default('');
            $table->integer('store_id')->unsigned();
            $table->smallInteger('qty')->unsigned()->notnull()->default(1);
            $table->timestamps();
            $table->index('store_id');
            $table->index('sku');
            $table->index('color');
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
        Schema::drop('stocks');
    }
}
