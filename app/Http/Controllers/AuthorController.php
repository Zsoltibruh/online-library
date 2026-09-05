<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $authors = Author::orderBy('name')->paginate(15);

        return view('authors.index', [
            'authors' => $authors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'required'],
            'birth' => ['date', 'required'],
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'required'],
            'birth' => ['date', 'required'],
        ]);

        $author->update($request->all());

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
