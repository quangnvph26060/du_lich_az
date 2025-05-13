<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('catalogue_id')->after('id');

            // Nếu có bảng catalogues để tạo ràng buộc foreign key:
            $table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['catalogue_id']);
            $table->dropColumn('catalogue_id');
        });
    }
};
