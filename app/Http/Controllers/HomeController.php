<?php
namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    public function dashboard() { return view('dashboard'); }
    public function home()
    {
        $books = Book::with(['author', 'category'])->get();
        return view('home', compact('books'));
    }

    
}
