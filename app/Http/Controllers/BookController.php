<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
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
        $category = $request->category;

        $books = Book::orderBy('title')
            ->with(['authors:id,name', 'categories'])
            ->when($search, function ($query, $search) {
                $query->whereFullText(['title', 'publication_year'], $search)
                    ->orWhereHas('authors', function ($query) use ($search) {
                        $query->whereFullText('name', $search);
                    });
            })
            ->when($category, function ($query, $category) {
                $query->whereHas('categories', function ($query) use ($category) {
                    $query->where(['id' => $category]);
                });
            })
            ->paginate(15);
        $authors = Author::orderBy('name')->get(['id', 'name']);
        $users = User::orderBy('name')->get(['id', 'name']);
        $categories = Category::orderBy('name')->get();

        return view('books.index', [
            'authors' => $authors,
            'books' => $books,
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    public function list(Request $request): View
    {
        $search = $request->search;
        $category = $request->category;

        $books = Book::orderBy('title')
            ->with(['authors:id,name', 'categories'])
            ->when($search, function ($query, $search) {
                $query->whereFullText(['title', 'publication_year'], $search)
                    ->orWhereHas('authors', function ($query) use ($search) {
                        $query->whereFullText('name', $search);
                    });
            })
            ->when($category, function ($query, $category) {
                $query->whereHas('categories', function ($query) use ($category) {
                    $query->where(['id' => $category]);
                });
            })
            ->withCount(['reservations' => function ($query) {
                $query->whereNotIn('status', [ReservationStatus::Reserved->value, ReservationStatus::Lost->value]);
            }])->paginate(15);

        $categories = Category::orderBy('name')->get();

        return view('books.list', [
            'books' => $books,
            'categories' => $categories,
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
