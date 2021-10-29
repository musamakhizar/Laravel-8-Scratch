<?php

namespace App\Models;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    
    public static function all()
    {
        $files =  File::files(resource_path("posts/"));

        return array_map(function ($file){
            return $file->getContents();
        }, $files);
        
    }
    
    public static function find($slug)
    {
        
        if(! file_exists($path = resource_path("posts/{$slug}.html"))) //he path of the dir containing files
        {
            // return redirect("/"); //this is not the job of the model and this method its only work is to find the file so this redirect should be deal by your controller or route because its their job to do this 
            throw new ModelNotFoundException();
        }
    
        $post = cache()->remember('post.{$slug}', now()->addMinute(60), fn() => file_get_contents($path));

        return $post;
    }
}
