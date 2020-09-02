<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/welcome', function () { ////when user get request to the /welcome, we response a welcome view [Resources->views folder]
//     return view('welcome');
// });


Route::get('test', function () { //user get request to /test, response with a test view
    return view('test');
});

// Route::get('/', function () { //when user get request to the homepage, we response a view [Resources->views folder]
//     $name = request('name'); //Call request func and provide the key we're looking for

//     return view('test', [ //This pass the $name to the test.blade view
//         'name' => $name
//     ]);
// });

// Route::get('/posts/{post}', function ($post) { //{}: accept a wild car, match '/posts' with anything, then a wild car $post then available in the callback function

//     if (! array_key_exists($post, $posts)){ //If the wild car is not exist inside the stimulated database, 404 code produced
//         abort(404, 'Sorry, that post was not found.');
//     }

//     return view('post', [
//         'post' => $posts[$post]
//     ]);
// });

Route::get('/posts/{post}', 'PostsController@show'); //Loading the controller PostsController and calling method show()

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {

    return view('about', [
        'articles' => App\Article::take(3)->latest()->get() //Fetch all articles, order by latest
    ]);
});

//This will route with a wild car which fetch a specific articleID
//->To Controller, then function show()
Route::get('/articles/{article}', 'ArticlesController@show');

//This will route to Controller, then function showAll()
Route::get('/articles', 'ArticlesController@showAll');