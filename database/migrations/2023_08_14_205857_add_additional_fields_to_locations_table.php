<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->float('reviews_rating_percentile')->nullable();
            $table->float('total_reviews_percentile')->nullable();
            $table->float('last_month_reviews_percentile')->nullable();
            $table->unsignedInteger('total_score')->nullable();
            $table->string('color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn([
                'reviews_rating_percentile',
                'total_reviews_percentile',
                'last_month_reviews_percentile',
                'total_score',
                'color'
            ]);
        });
    }
}
