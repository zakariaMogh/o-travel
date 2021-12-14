<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_offer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('company_id')->constrained()
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
        Schema::table('company_offer', function (Blueprint $table) {
            $table->dropForeign('company_offer_offer_id_foreign');
            $table->dropForeign('company_offer_company_id_foreign');
        });
        Schema::dropIfExists('company_offer');
    }
}
