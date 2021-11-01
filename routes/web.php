<?php

use App\Models\Post;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    return view('posts',
    [
        'posts' => Post::all()
    ]);
});


//Route::get('/post/{slug}', [PostController::class,'old_one'])->where('post','[A-z0-9\_-]+'); //constraint
Route::get('/post/{slug}', [PostController::class,'new_one']); //constraint
