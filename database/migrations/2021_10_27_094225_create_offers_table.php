<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date')->nullable();
            $table->double('price');
            $table->date('published_at')->nullable();
            $table->text('description')->nullable();
            $table->double('rate')->nullable();
            $table->string('link')->nullable();
            $table->integer('state')->default(1); // 1:inactive -- 2:active
            $table->foreignId('company_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('featured')->default(1); // 1:inactive -- 2:active;
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
}
