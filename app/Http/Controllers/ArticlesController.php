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

    public function show($id) //Show a specific one
    {
        //Show a single resource

        $article = Article::find($id);

        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function create()
    {
        //Shows a view to create a new resource

        return view('articles.create');
    }

    public function store()
    {
        //validation

        //Persist the new resource
        $article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();

        return redirect('/articles');
    }

    public function edit()
    {
        //Show a view to edit an existing resource
    }

    public function update()
    {
        //Persist the editted resource
    }

    public function destroy()
    {
        //Delete the resource
    }
}
