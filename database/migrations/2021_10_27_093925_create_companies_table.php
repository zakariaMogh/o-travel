<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('country_code')->nullable();;
            $table->string('device_token')->nullable();
            $table->double('wallet',14,2)->default(0);
            $table->integer('max_number_of_offers');
            $table->integer('state')->default(1); // 1: active - 2: banned
            $table->integer('story_state')->default(1); // 1: active - 2: inactive
            $table->integer('auto_accepted')->default(1); // 1: inactive - 2: active
            $table->boolean('checked')->default(false); // 1 : true - 0 : false
            $table->boolean('SML_visibility')->default(2); // 1 : disable - 2 : enable
            $table->text('facebook')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('snapchat')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('description')->nullable();
            $table->string('trade_register')->nullable();
            $table->double('rate')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->text('address')->nullable();

            $table->foreignId('city_id')->nullable()->constrained()
                ->onDelete('set null')->onUpdate('cascade');

            $table->foreignId('domain_id')->nullable()->constrained()
                ->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('companies');
    }
}
