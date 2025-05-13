<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoScoresTable extends Migration
{
    public function up(): void
    {
        Schema::create('seo_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id'); // liên kết với bảng blogs
            $table->string('keyword'); // từ khóa chính được phân tích
            $table->integer('seo_score'); // điểm SEO tổng thể (0 - 100)
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->index('blog_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_scores');
    }
}
