<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    // 7 RESTful API control actions
    //Show ALL, show specific, create, store, edit, update, destroy

    public function index() //Show all, //Render a list of a resource
    {
        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrfail()->articles;
        } else {
            $articles = Article::latest()->get();
        }

        return view('articles.index', [ //articles.index (folder->file)
            'articles' => $articles
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

    public function create() //Shows a view to create a new resource
    {
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store() //Persist the new resource
    {
        // dd(request()->all());
        // $article = Article::create($this->validateArticle());

        //validation
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1; //auth()->id()
        $article->save();

        $article->tags()->attach(request('tags')); // [1,2,3]

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
            'tags' => 'exists:tags,id'
        ]);
    }
}
