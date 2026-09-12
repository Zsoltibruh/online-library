<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->search;

        $books = Book::orderBy('title')
            ->with('authors:id,name')
            ->when($search, function ($query, $search) {
                $query->whereFullText('title', $search)
                    ->orWhereHas('authors', function ($query) use ($search) {
                        $query->whereFullText('name', $search);
                    });
            })
            ->paginate(15);
        $authors = Author::orderBy('name')->get(['id', 'name']);
        $users = User::orderBy('name')->get(['id', 'name']);

        return view('books.index', [
            'books' => $books,
            'authors' => $authors,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $book = Book::create($validated);
            $book->authors()->attach($validated['author_ids']);
        });

        return redirect()->route('books.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $book) {
            $book->update($validated);
            $book->authors()->sync($validated['author_ids']);
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
