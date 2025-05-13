<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title")->unique();
            $table->string("slug")->unique();
            $table->string("image");

            $table->string("short_description")->nullable();
            $table->longText("content");

            $table->dateTime("posted_at")->nullable();
            $table->dateTime("remove_at")->nullable();
            $table->string("view_count");
            $table->boolean("status")->default(false);

            $table->json("tags")->nullable();

            $table->string("seo_title")->nullable();
            $table->text("seo_description")->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');

    }
};
