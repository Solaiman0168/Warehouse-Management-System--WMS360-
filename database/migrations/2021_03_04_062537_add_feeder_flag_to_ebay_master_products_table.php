<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeederFlagToEbayMasterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebay_master_products', function (Blueprint $table) {
            //
            $table->boolean('feeder_flag')->default(false)->comment('1 = update from feeder,0 = don\'t update from feeder');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ebay_master_products', function (Blueprint $table) {
            //
        });
    }
}