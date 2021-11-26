<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function ver_2($slug)
    {
        //find a post by its slug and pass it to a view called post
        //CodeClean,Filesystem Class(Model),Controller,Dynamic Post Home
        return view('post', [
            'post' => Post::find($slug)
        ]);
    }

    public function ver_1($slug)
    {
        //-- Security check file exists by passing the file path and calling file_exists function --//
            if(! file_exists($path = __DIR__ . "/../../../resources/posts/{$slug}.html")) //he path of the dir containing files
            {
                return redirect("/"); // -> if post (file) does'nt exists then redirect back to the home page 
            }
        //-- Caching File --//
        
            $post = cache()->remember("post.{$slug}", now()->addMinute(60), function () use ($path){
                return file_get_contents($path); //read file into a string from the given path 
            });

        //-- short closure or arrow function --//
        // $post = cache()->remember('post.{$slug}', now()->addMinute(60), fn() => file_get_contents($path));

            return view('post', compact('post'));
    }
}
