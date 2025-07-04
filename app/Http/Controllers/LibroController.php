<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Book::with(['author','category'])->get();
        return view('admin.libros.index', compact('libros'));
    }

    public function create()
    {
        $autores     = Author::all();
        $categorias  = Category::all();
        return view('admin.libros.create', compact('autores','categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => 'required|string',
            'author_id'   => 'required|exists:oracle.authors,id',
            'category_id' => 'required|exists:oracle.categories,id',
            'isbn'        => 'required|unique:oracle.libros,isbn',
            'publicacion' => 'nullable|date',
        ]);

        Book::create($data);

        return redirect()->route('admin.libros.index')
                    ->with('success','Libro creado.');
    }

    public function edit($id)
    {
        $libro       = Book::findOrFail($id);
        $autores     = Author::all();
        $categorias  = Category::all();
        return view('admin.libros.edit', compact('libro','autores','categorias'));
    }

    public function update(Request $request, $id)
    {
        $libro = Book::findOrFail($id);

        $data = $request->validate([
            'titulo'      => 'required|string',
            'author_id'   => 'required|exists:oracle.authors,id',
            'category_id' => 'required|exists:oracle.categories,id',
            'isbn'        => "required|unique:oracle.libros,isbn,{$libro->id_libro},id_libro",
            'publicacion' => 'nullable|date',
        ]);

        $libro->update($data);

        return redirect()->route('admin.libros.index')
                    ->with('success','Libro actualizado.');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return back()->with('success','Libro eliminado.');
    }
}
