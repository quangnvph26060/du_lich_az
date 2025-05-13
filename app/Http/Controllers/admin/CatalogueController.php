<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SebastianBergmann\CodeUnit\FunctionUnit;

class CatalogueController extends Controller
{
    public function index()
    {
        $catalogues = Catalogue::all();
        return view('backend.catalogue.index', compact('catalogues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:catalogues,name',

        ]);

        Catalogue::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)

        ]);

        // dd($request->all());

        return redirect()->route('admin.catalogues.index')->with('success', 'Thêm mới thành công');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:catalogues,name,' . $id,
        ]);

        $catalogue = Catalogue::where('id', $id)->firstOrFail();

        $catalogue->name = $request->input('name');
        $catalogue->slug = Str::slug($request->input('name'));

        $catalogue->save();

        return back()->with('success', 'Cập nhật thành công');
    }

    public function softDelete($id)
    {
        $catalogue = Catalogue::find($id);
        $catalogue->delete();
        return back()->with('success', 'Đã được chuyển vào thùng rác');
    }

    public function delete($id)
    {
        $catalogue = Catalogue::onlyTrashed()->find($id);
        $catalogue->forceDelete();
        return back()->with('success', 'Xóa thành công');
    }

    public function trash()
    {
        $catalogues = Catalogue::onlyTrashed()->paginate(10);
        return view('backend.catalogue.trash', compact('catalogues'));
    }

    public function restore($id)
    {
        $catalogue = Catalogue::onlyTrashed()->find($id);
        $catalogue->restore();
        return back()->with('success', 'Đã khôi phục thành công');
    }
    
}
