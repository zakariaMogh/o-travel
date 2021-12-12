<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_country', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('category_country', function (Blueprint $table) {
            $table->dropForeign('category_country_country_id_foreign');
            $table->dropForeign('category_country_category_id_foreign');
        });
        Schema::dropIfExists('category_country');
    }
}
