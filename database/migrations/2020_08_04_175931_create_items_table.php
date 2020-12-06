<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('poster')->nullable();
            $table->string('cover')->nullable();
            $table->enum('type', ['Movie', 'Series']);
            $table->string('release_year')->nullable();
            $table->string('content_rating')->nullable();
            $table->string('imdb_rating')->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('language_id')->default(0);
            $table->text('description')->nullable();
            $table->integer('watch_count')->default(0);
            $table->integer('download_count')->default(0);
            $table->integer('is_feature')->default(0);
            $table->enum('stauts',['Complete', 'Ongoing'])->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('items');
    }
}
