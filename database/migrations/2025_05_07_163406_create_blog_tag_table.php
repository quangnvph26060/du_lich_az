<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('blog_tag', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('blog_id');
        $table->unsignedBigInteger('tag_id');
        $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('blog_tag');
}

};
