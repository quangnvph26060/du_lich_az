<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Catalogue;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        // Lấy bài viết nổi bật
        $highlightBlogs = Blog::where('status', 1)
            ->orderBy('view_count', 'desc')
            ->take(3)
            ->get();


        // Lấy bài viết mới nhất
        $latesBlogs = Blog::where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        // Lấy danh sách bài viết có phân trang
        $listBlogs = Blog::where('status', 1)
            ->latest()
            ->paginate(10);

        // Lấy bài viết theo danh mục
        $catalogueBlogs = [];
        $catalogueNames = [
            'Du lịch' => 'du-lich',
            'Thể thao' => 'the-thao',
            'Pháp luật' => 'phap-luat',
            'Đời sống' => 'doi-song'
        ];

        foreach ($catalogueNames as $name => $slug) {
            $catalogue = Catalogue::where('slug', $slug)->first();
            if ($catalogue) {
                $catalogueBlogs[$name] = Blog::where('status', 1)
                    ->where('catalogue_id', $catalogue->id)
                    ->latest()
                    ->take(4)
                    ->get();
            }
        }

        return view('frontend.page.home', compact(
            'highlightBlogs',
            'latesBlogs',
            'listBlogs',
            'catalogueBlogs'
        ));
    }
}
