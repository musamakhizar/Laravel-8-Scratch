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

Route::get('/', function () {
    $page_title = "Home Page";
    return view('posts',compact('page_title'));
});


Route::get('/post/{post}', function ($slug) {
    
    //-- The path of the dir containing files --//

    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    //-- Security check file exists by passing the file path and calling file_exists function --//
    if(! file_exists($path))
    {
        //dd("Not exists");
        //abort(404);
        return redirect("/"); // -> if post (file) does'nt exists then redirect back to the home page 
    }
    //dd("File exits");

    $post = file_get_contents($path); //read file into a string from the given path

    return view('post', compact('post'));
})->where('post','[A-z0-9\_-]+'); //constraint
