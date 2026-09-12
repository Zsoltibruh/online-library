<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->search;

        $authors = Author::orderBy('name')
            ->with('books:id,title')
            ->when($search, function ($query, $search) {
                $query->whereFullText('name', $search)
                    ->orWhereHas('books', function ($query) use ($search) {
                        $query->whereFullText('title', $search);
                    });
            })
            ->paginate(15);

        return view('authors.index', [
            'authors' => $authors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Author::create($validated);

        return redirect()->route('authors.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $validated = $request->validated();

        $author->update($validated);

        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('authors.index');
    }
}
