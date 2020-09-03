<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    // 7 RESTful API control actions
    //Show ALL, show specific, create, store, edit, update, destroy

    public function index() //Show all
    {
        //Render a list of a resource

        $article = Article::latest()->get();

        return view('articles.index', [ //articles.index (folder->file)
            'articles' => $article
        ]);
    }

    public function show(Article $article) //Intance with a wildcard from Route::
    {
        //Show a single resource

        // $article = Article::findOrFail($id); //if not found, throws 404

        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function create()
    {
        //Shows a view to create a new resource
        return view('articles.create');
    }

    public function store() //Persist the new resource
    {
        //validation
        Article::create($this->validateArticle());

        return redirect(route('articles.index'));
    }

    public function edit(Article $article) //Show a view to edit an existing resource
    {
        //Find the article associated with the id
        // $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article) //Persist the editted resource
    {

        //validation
        $validatedAttributes = $this->validateArticle();
        $article->update($validatedAttributes);

        // return redirect('/articles/' . $article->id);
        return redirect($article->path());
    }

    public function destroy()
    {
        //Delete the resource
    }

    protected function validateArticle() //If there is a new field, just add it here for validation
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);
    }
}
