<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $autores = Author::all();
        return view('admin.autores.index', compact('autores'));
    }

    public function create() {
        return view('admin.autores.create');
    }

    public function store(Request $r) {
        $r->validate(['name' => 'required|unique:oracle.authors,name']);
        Author::create(['name' => $r->name]);
        return redirect()->route('admin.autores.index')->with('success', 'Autor creado.');
    }

    public function edit(Author $autor) {
        return view('admin.autores.edit', compact('autor'));
    }

    public function update(Request $r, Author $autor) {
        $r->validate(['name' => "required|unique:oracle.authors,name,{$autor->id}"]);
        $autor->update(['name' => $r->name]);
        return redirect()->route('admin.autores.index')->with('success', 'Autor actualizado.');
    }

    public function destroy(Author $autor) {
        $autor->delete();
        return back()->with('success', 'Autor eliminado.');
    }
}
