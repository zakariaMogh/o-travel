<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->integer('type')->default(1); // 1 : image 2: video
            $table->longText('meta')->nullable();
            $table->integer('views')->default(0);
            $table->integer('state')->default(1); // 1 : visible 2: invisible
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
        Schema::table('stories', function (Blueprint $table) {
            $table->dropForeign('stories_company_id_foreign');

        });
        Schema::dropIfExists('stories');
    }
}
