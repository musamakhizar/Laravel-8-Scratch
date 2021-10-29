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


Route::get('/post/{post}', function ($post) {
    $post = file_get_contents(__DIR__ . "/../resources/posts/{$post}.html");
    return view('post', compact('post'));
});
