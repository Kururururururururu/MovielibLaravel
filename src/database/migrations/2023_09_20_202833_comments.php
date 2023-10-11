<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('movie_id');
//final should be ->            $table->integer('author_id');//->references('id')->on('users')
            $table->string('author');
            $table->text('comment');
            $table->timestamps();
            $table->index('movie_id', 'movie_id_index');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
