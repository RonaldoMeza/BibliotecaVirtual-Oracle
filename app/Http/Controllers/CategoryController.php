<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categorias = Category::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create() {
        return view('admin.categorias.create');
    }

    public function store(Request $r) {
        $r->validate(['name' => 'required|unique:oracle.categories,name']);
        Category::create(['name' => $r->name]);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada.');
    }

    public function edit(Category $categoria) {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $r, Category $categoria) {
        $r->validate(['name' => "required|unique:oracle.categories,name,{$categoria->id}"]);
        $categoria->update(['name' => $r->name]);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada.');
    }

    public function destroy(Category $categoria) {
        $categoria->delete();
        return back()->with('success', 'Categoría eliminada.');
    }
}
