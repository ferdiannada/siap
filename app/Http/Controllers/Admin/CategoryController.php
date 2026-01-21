<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('aspirasi')
            ->latest()
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:categories,nama',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nama' => 'required|unique:categories,nama,' . $category->id,
        ]);

        $category->update([
            'nama' => $request->nama,
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $category = Category::withCount('aspirasi')->findOrFail($id);

        if ($category->aspirasi_count > 0) {
            return back()->with('error',
                'Kategori tidak bisa dihapus karena sudah digunakan pada aspirasi.'
            );
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }

}
