<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Catalogue;

class BlogController extends Controller
{
    public function detail($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 1)
            ->with(['catalogue', 'tags', 'keywords'])
            ->firstOrFail();

        // Tăng lượt xem
        $blog->increment('view_count');

        // Lấy catalogue
        $catalogue = Catalogue::all();

        // Lấy các bài viết cùng danh mục (trừ bài viết hiện tại)
        $relatedBlogs = Blog::where('catalogue_id', $blog->catalogue_id)
            ->where('id', '!=', $blog->id)
            ->where('status', 1)
            ->orderBy('posted_at', 'desc')
            ->take(5)
            ->get();

        // Lấy bài viết nổi bật
        $highlightBlogs = Blog::where('status', 1)
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        // Lấy bài viết mới nhất
        $newBlogs = Blog::where('status', 1)
            ->latest()
            ->take(10)
            ->get();

        // Lấy các bài viết đọc nhiều cùng danh mục
        $relatedBlogsHighLight = Blog::where('catalogue_id', $blog->catalogue_id)
            ->where('id', '!=', $blog->id)
            ->where('status', 1)
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        return view('frontend.page.detailBlog', compact('blog', 'catalogue', 'relatedBlogs', 'highlightBlogs', 'newBlogs', 'relatedBlogsHighLight'));
    }
}