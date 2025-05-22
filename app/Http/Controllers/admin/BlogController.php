<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Catalogue;
use App\Models\Keyword;
use App\Models\SeoScore;
use App\Models\Tag;
use App\RankmathSEOForLaravel\Services\SeoAnalyzer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with(['seoScore','catalogue'])->get();
        return view('backend.blogs.index', compact('blogs'));
    }


    public function create(Request $request)
    {
        $blog = new Blog();

        $blog->tag_ids = [];
        $blog->keyword_ids = [];
        $catalogues = Catalogue::all();
        $tags = Tag::all();
        $keywords = Keyword::all();
        $seoData = $this->getSeoAnalysis($request);

        return view(
            'backend.blogs.form',
            compact('catalogues', 'tags', 'keywords', 'blog', 'seoData')

        );

    }

    public function edit(Request $request, $id)
    {
        $blog = Blog::with('blogTags', 'keywords')->findOrFail($id);
        // dd($blog->blogTags, $blog->keywords);
        $catalogues = Catalogue::all();
        $tags = Tag::all();
        $keywords = Keyword::all();

        $seoData = $this->getSeoAnalysis($request, $id);
        if (isset($seoData['analysis']) && is_array($seoData['analysis'])) {
            $seoData['analysis'] = collect($seoData['analysis'])
                ->unique(function ($item) {
                    return $item['status'] . $item['message'];
                })
                ->values()
                ->toArray();
        }

        if (isset($seoData['suggestions']) && is_array($seoData['suggestions'])) {
            $seoData['suggestions'] = collect($seoData['suggestions'])
                ->unique(function ($item) {
                    return $item['status'] . $item['message'];
                })
                ->values()
                ->toArray();
        }
        // dd(vars: $seoData);

        return view(
            'backend.blogs.form',
            compact('catalogues', 'tags', 'keywords', 'blog', 'seoData')

        );
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'content' => 'required|string',
            'catalogue_id' => 'required|integer|exists:catalogues,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'short_description' => 'nullable|string|max:500',

            // SEO Fields
            'seo_title' => 'nullable|string|max:60', // Tối ưu: 50-60 ký tự
            'seo_description' => 'nullable|string|max:160', // Tối ưu: 120-160 ký tự

            // Optional SEO fields
            'tags' => 'nullable',
            'tags.*' => 'string|max:30',

            'keywords' => 'nullable',
            'keywords.*' => 'string|max:30',

            'status' => 'nullable|boolean',
            'posted_at' => 'nullable|date',
            'remove_at' => 'nullable|date',
        ]);


        if (!empty($request->tags)) {
            // Giải mã chuỗi JSON thành mảng
            $tagsArray = json_decode($request->tags, true);
            $keywordsArray = json_decode($request->keywords, true);

            $tags = array_map(fn($tag) => $tag['value'], $tagsArray);
            $keywords = array_map(fn($keyword) => $keyword['value'], $keywordsArray);

            // dd(vars: $tags);

            $arrayTags = [];
            $arrayKeywords = [];

            foreach ($tags as $item) {
                $tag = Tag::query()->updateOrCreate(['name' => $item], ['slug' => Str::slug($item)]);
                $arrayTags[] = $tag->id;

            }

            foreach ($keywords as $item) {
                $keyword = Keyword::query()->updateOrCreate(['name' => $item], ['slug' => Str::slug($item)]);
                $arrayKeywords[] = $keyword->id;
            }

        }

        try {
            // dd(vars: $request->all());
            // Tạo danh mục mới
            $blog = Blog::create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->title),
                'content' => $request->input('content'),
                'image' => saveImage($request, 'image', 'new_images'),
                'catalogue_id' => $request->input('catalogue_id'),
                'short_description' => $request->input('short_description'),
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'posted_at' => now(),
                'view_count' => '0',
                'status' => $request->input('status', 0),
            ]);

            // Gán các tags và keywords cho bài viết
            $blog->blogTags()->sync($arrayTags);
            $blog->keywords()->sync($arrayKeywords);


            // Sau khi blog đã được tạo và gán từ khóa, tag
            $focusKeyword = $blog->keywords->first()->name ?? '';
            $analyzer = app(SeoAnalyzer::class);

            dd(
                $blog->seo_title,
                $blog->content,
                $focusKeyword,
                $blog->seo_description ?? '',
                $blog->slug
            );
            $analysisResult = $analyzer->analyze(
                $blog->seo_title,
                $blog->content,
                $focusKeyword,
                $blog->seo_description ?? '',
                $blog->slug
            );

            $analysis = collect($analysisResult->checks ?? []);
            $suggestions = collect($analysisResult->suggestions ?? []);
            $seoScoreValue = $this->calculateSeoScore($analysis, $suggestions);

            // Lưu điểm SEO
            $this->saveSEOScore($blog, $seoScoreValue);
            return redirect()->route('admin.blogs.index')->with('success', 'Bài viết đã được thêm thành công');
        } catch (\Exception $e) {
            // Nếu có lỗi, bắt và hiển thị thông báo lỗi
            logger($e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        try {

            $blog = Blog::findOrFail($id);
            $slug = $request->input('slug') ?? Str::slug($request->input('title'));

            $request->merge(['slug' => $slug]);

            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $id,
                'content' => 'required|string',
                'catalogue_id' => 'required|integer|exists:catalogues,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'short_description' => 'nullable|string|max:500',
                'seo_title' => 'nullable|string|max:60',
                'seo_description' => 'nullable|string|max:160',
                'tags' => 'nullable',
                'tags.*' => 'string',
                'keywords' => 'nullable',
                'keywords.*' => 'string',
                'status' => 'nullable|boolean',
                'posted_at' => 'nullable',
                'remove_at' => 'nullable',
            ]);

            if (!empty($request->tags)) {
                // Giải mã chuỗi JSON thành mảng
                $tagsArray = json_decode($request->tags, true);
                $keywordsArray = json_decode($request->keywords, true);

                $tags = array_map(fn($tag) => $tag['value'], $tagsArray);
                $keywords = array_map(fn($keyword) => $keyword['value'], $keywordsArray);

                $arrayTags = [];
                $arrayKeywords = [];

                foreach ($tags as $item) {
                    $tag = Tag::query()->updateOrCreate(['name' => $item], ['slug' => Str::slug($item)]);
                    $arrayTags[] = $tag->id;
                }

                foreach ($keywords as $item) {
                    $keyword = Keyword::query()->updateOrCreate(['name' => $item], ['slug' => Str::slug($item)]);
                    $arrayKeywords[] = $keyword->id;
                }

                // Cập nhật tags và keywords
                $blog->blogTags()->sync($arrayTags);
                $blog->keywords()->sync($arrayKeywords);
            }

            $credentials = $request->only([
                'title',
                'slug',
                'content',
                'catalogue_id',
                'short_description',
                'seo_title',
                'seo_description',
                'status',
                'posted_at',
                'remove_at'
            ]);


            if ($request->hasFile('image')) {
                // Xóa ảnh cũ nếu tồn tại
                if ($blog->image && file_exists(public_path($blog->image))) {
                    unlink(public_path($blog->image));
                }
                $credentials['image'] = saveImage($request, 'image', 'new_images');
            }

            $blog->update($credentials);

            $seoData = $this->getSeoAnalysis(new Request(), $blog->id);
            $seoScoreValue = $seoData['seoScoreValue'];

            $this->saveSEOScore($blog, $seoScoreValue);

            return redirect()->back()->with('success', 'Bài viết đã được sửa thành công');
        } catch (\Exception $e) {
            // Nếu có lỗi, bắt và hiển thị thông báo lỗi
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Xóa ảnh nếu tồn tại
            if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
                unlink(public_path('storage/' . $blog->image));
            }

            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'Xóa bài viết thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Tính điểm
    private function calculateSeoScore($analysis, $suggestions)
    {
        $allItems = collect($analysis)->merge($suggestions);

        $totalCriteria = $allItems->count();

        $successCount = $allItems->where('status', 'success')->count();
        $warningCount = $allItems->where('status', 'warning')->count();
        $failCount = $allItems->where('status', 'danger')->count();

        if ($totalCriteria === 0) {
            return 0;
        }

        $score = ($successCount * 1 + $warningCount * 0.5 + $failCount * 0) / $totalCriteria * 100;

        return round($score);
    }

    // Lưu điểm SEO
    public function saveSEOScore(Blog $blog, $seoScoreValue)
    {
        SeoScore::updateOrCreate(
            ['blog_id' => $blog->id],
            ['seo_score' => $seoScoreValue]
        );
    }

    public function getSeoAnalysis(Request $request, $id = null)
    {
        if (!$id) {
            return [
                'blog' => null,
                'seoScore' => null,
                'keywords' => [],
                'analysis' => [],
                'suggestions' => [],
                'hasWarning' => false,
                'seoScoreValue' => 0,
            ];
        }

        $blog = Blog::findOrFail($id);


        $focusKeyword = $blog->keywords->first()->name ?? '';

        $analyzer = app(SeoAnalyzer::class);
        // dd($blog->seo_title, $blog->content, $focusKeyword, $blog->seo_description ?? '', $blog->slug);

        $analysisResult = $analyzer->analyze($blog->seo_title = '', $blog->content, $focusKeyword, $blog->seo_description ?? '', $blog->slug);

        $analysis = collect($analysisResult->checks)->map(function ($item) {
            $status = $item['status'] ?? ($item['passed'] ? 'success' : 'warning');
            return array_merge($item, ['status' => $status]);
        })->toArray();

        $suggestions = collect($analysisResult->suggestions ?? [])->map(function ($item) {
            $status = $item['status'] ?? ($item['passed'] ? 'success' : 'info');
            return array_merge($item, ['status' => $status]);
        })->toArray();


        $seoScoreValue = $this->calculateSeoScore($analysis, $suggestions);
        $hasWarning = $seoScoreValue < 80 || collect($analysis)->contains(fn($item) => $item['passed'] === false);

        $seoScore = SeoScore::where('blog_id', $blog->id)->first();

        return [
            'blog' => $blog,
            'seoScore' => $seoScore,
            'keywords' => $blog->keywords,
            'analysis' => $analysis,
            'suggestions' => $suggestions,
            'hasWarning' => $hasWarning,
            'seoScoreValue' => $seoScoreValue,
        ];
    }

    public function getSeoAnalysisLive(Request $request)
    {
        $seoTitle = $request->seo_title ?? '';
        $content = $request->content ?? '';
        $slug = $request->slug ?? '';
        $seoDescription = $request->seo_description ?? '';
        $keywords = $request->input('keywords', []);
        $focusKeyword = is_array($keywords) ? ($keywords[0] ?? '') : $keywords;
        $short_description = $request->short_description ?? '';

        $analyzer = app(SeoAnalyzer::class);

        $analysisResult = $analyzer->analyze($seoTitle, $content, $focusKeyword, $seoDescription, $slug);
        $analysis = collect($analysisResult->checks)->map(function ($item) {
            $status = $item['status'] ?? ($item['passed'] ? 'success' : 'warning');
            return array_merge($item, ['status' => $status]);
        })->toArray();

        $suggestions = collect($analysisResult->suggestions ?? [])->map(function ($item) {
            $status = $item['status'] ?? ($item['passed'] ? 'success' : 'info');
            return array_merge($item, ['status' => $status]);
        })->toArray();

        $seoScoreValue = $this->calculateSeoScore($analysis, $suggestions);
        $hasWarning = $seoScoreValue < 80 || collect($analysis)->contains(fn($item) => $item['passed'] === false);

        $seoData = [
            'analysis' => $analysis,
            'suggestions' => $suggestions,
            'seoScoreValue' => $seoScoreValue,
            'hasWarning' => $hasWarning,
        ];

        $seoScoreValue = $seoData['seoScoreValue'] ?? 0;
        $seoColor = 'bg-danger'; // đỏ mặc định (dưới 50)
        $badgeClass = 'bg-danger';

        if ($seoScoreValue >= 80) {
            $seoColor = 'bg-success'; // xanh lá (tốt)
            $badgeClass = 'bg-success';
        } elseif ($seoScoreValue >= 50) {
            $seoColor = 'bg-warning'; // vàng (trung bình)
            $badgeClass = 'bg-warning text-dark';
        }

        // dd(vars: $seoData);

        $view = view('backend.blogs.seo', compact('seoData'))->render();
        return response()->json([
            'success' => true,
            'html' => $view,
            'seoScoreVal' => $seoScoreValue,
            'seoColor' => $seoColor,
            'badgeClass' => $badgeClass
        ]);
    }
}
