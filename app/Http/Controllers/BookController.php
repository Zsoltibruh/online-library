<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = Book::orderBy('title')->paginate(15);

        return view('books.index', [
            'books' => $books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['string', 'required'],
            'publication_year' => ['string', 'min_digits:4', 'required'],
            'count' => ['numeric', 'max:99', 'required']
        ]);

        Book::create($request->all());

        return redirect()->route('books.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
            'title' => ['string', 'required'],
            'publication_year' => ['string', 'min_digits:4', 'required'],
            'count' => ['numeric', 'max:99', 'required']
        ]);

        $book->update($request->all());

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}
