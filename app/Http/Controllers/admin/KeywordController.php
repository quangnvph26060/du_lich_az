<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KeywordController extends Controller
{
    public function index()
    {
        $keywords = Keyword::paginate(10);
        // dd(vars: $keywords->all());
        return view('backend.keyword.index', compact('keywords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:keywords,name',
        ]);

        Keyword::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success', 'Thêm mới thành công');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:keywords,name,' . $id,
        ]);

        $keyword = Keyword::where('id', $id)->firstOrFail();

        $keyword->name = $request->input('name');
        $keyword->slug = Str::slug($request->input('name'));

        $keyword->save();

        return back()->with('success', 'Cập nhật thành công');
    }



    public function softDelete($id)
    {
        $keyword = Keyword::where('id', $id)->firstOrFail();
        $keyword->delete();

        return back()->with('success', value: 'Đã được chuyển vào thùng rác');
    }

    public function delete($id)
    {
        $keyword = Keyword::withTrashed()->find($id);
        $keyword->forceDelete();
        return back()->with('success', 'Xóa thành công');

    }

    public function trash()
    {
        $keywords = Keyword::onlyTrashed()->paginate(10);

        return view('backend.keyword.trash', compact('keywords'));

    }

    public function restore($id)
    {
        $keyword = Keyword::withTrashed()->find($id);
        $keyword->restore();
        return back()->with('success', 'Khôi phục thành công');

    }


}