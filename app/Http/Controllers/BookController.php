<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = Book::orderBy('title')
            ->with('authors:id,name')
            ->paginate(15);
        $authors = Author::orderBy('name')->get(['id', 'name']);

        return view('books.index', [
            'books' => $books,
            'authors' => $authors,
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
            'count' => ['numeric', 'max:99', 'required'],
            'author_ids' => ['array', 'min:1', 'required'],
            'author_ids.*' => ['exists:authors,id'],
        ]);

        DB::transaction(function () use ($request) {
            $book = Book::create($request->all());
            $book->authors()->attach($request['author_ids']);
        });

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

        DB::transaction(function () use ($request, $book) {
            $book->update($request->all());
            $book->authors()->sync($request['author_ids']);
        });

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
