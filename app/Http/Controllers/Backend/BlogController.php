<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Keyword;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function create()
    {
        $blog = new Blog();
        $blog->tags = collect([]);
        $blog->keywords = collect([]);
        return view('backend.blogs.form', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('backend.blogs.form', compact('blog'));
    }

    public function store(BlogRequest $request)
    {
        try {
            DB::beginTransaction();
            
            // Tạo blog mới
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'status' => $request->status,
                // Thêm các trường khác nếu cần
            ]);

            // Xử lý tags
            if ($request->has('tags')) {
                $tagIds = [];
                foreach ($request->tags as $tagName) {
                    $tag = Tag::firstOrCreate(
                        ['name' => $tagName],
                        ['slug' => Str::slug($tagName)]
                    );
                    $tagIds[] = $tag->id;
                }
                $blog->tags()->sync($tagIds);
            }

            // Xử lý keywords
            if ($request->has('keywords')) {
                $keywordIds = [];
                foreach ($request->keywords as $keywordName) {
                    $keyword = Keyword::firstOrCreate(
                        ['name' => $keywordName],
                        ['slug' => Str::slug($keywordName)]
                    );
                    $keywordIds[] = $keyword->id;
                }
                $blog->keywords()->sync($keywordIds);
            }

            DB::commit();
            return redirect()->route('admin.blogs.index')->with('success', 'Thêm bài viết thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        try {
            DB::beginTransaction();
            
            // Cập nhật thông tin blog
            $blog->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'status' => $request->status,
                // Thêm các trường khác nếu cần
            ]);

            // Xử lý tags
            if ($request->has('tags')) {
                $tagIds = [];
                foreach ($request->tags as $tagName) {
                    $tag = Tag::firstOrCreate(
                        ['name' => $tagName],
                        ['slug' => Str::slug($tagName)]
                    );
                    $tagIds[] = $tag->id;
                }
                $blog->tags()->sync($tagIds);
            } else {
                $blog->tags()->detach();
            }

            // Xử lý keywords
            if ($request->has('keywords')) {
                $keywordIds = [];
                foreach ($request->keywords as $keywordName) {
                    $keyword = Keyword::firstOrCreate(
                        ['name' => $keywordName],
                        ['slug' => Str::slug($keywordName)]
                    );
                    $keywordIds[] = $keyword->id;
                }
                $blog->keywords()->sync($keywordIds);
            } else {
                $blog->keywords()->detach();
            }

            DB::commit();
            return redirect()->route('admin.blogs.index')->with('success', 'Cập nhật bài viết thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
} 