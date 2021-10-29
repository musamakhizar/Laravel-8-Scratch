<?php

namespace App\Models;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    //Initiate a post and put the yamal object data to your post class
    public $title;
    public $slug;
    public $excerpt;
    public $date;
    public $body;

    public function __construct($title,$excerpt,$date,$body)
    {
        $this->title = $title;
        $this->slug = Str::slug($this->title,"-");
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }

    public static function all()
    {
        //-- Collection Approach --//
        return collect(File::files(resource_path("posts/")))
        ->map(function($file){
            $document = YamlFrontMatter::parseFile($file);
            return new Post(
                $document->matter('title'),
                $document->matter('excerpt'),
                $document->matter('date'),
                $document->body()
            );
        })->sortByDesc('date');
        
        
        //$files =  File::files(resource_path("posts/"));

        //-- Looping and putting in an array --//
    
        // $posts = [];
        // foreach($files as $file)
        // {
        //     //$documents,YamlFrontMatter::parseFile($file));
        //     $post_yaml_obj = YamlFrontMatter::parseFile($file);
        //     array_push(
        //         $posts,
        //         new Post(
        //                 $post_yaml_obj->matter('title'),
        //                 $post_yaml_obj->matter('excerpt'),
        //                 $post_yaml_obj->matter('date'),
        //                 $post_yaml_obj->body()
        //             ) 
        //     );
        // }
        
        //-- Looping and putting in an array uisng array_map function approach which simplifies the process --//
        
        // $posts = array_map(function($file){
        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post(
        //         $document->matter('title'),
        //         $document->matter('excerpt'),
        //         $document->matter('date'),
        //         $document->body()
        //     );
        // },$files);
    
       
    
    }


    public static function find($slug)
    {
        $posts = static::all();
        
        return $posts->firstWhere('slug',$slug);
    }

    //-- Old One Before Yaml Implementation --//
    // public static function all()
    // {
    //     $files =  File::files(resource_path("posts/"));

    //     return array_map(function ($file){
    //         return $file->getContents();
    //     }, $files);
        
    // }
    
    //-- Old one before Yaml --//

    // public static function find($slug)
    // {
        
    //     if(! file_exists($path = resource_path("posts/{$slug}.html"))) //he path of the dir containing files
    //     {
    //         // return redirect("/"); //this is not the job of the model and this method its only work is to find the file so this redirect should be deal by your controller or route because its their job to do this 
    //         throw new ModelNotFoundException();
    //     }
    
    //     $post = cache()->remember('post.{$slug}', now()->addMinute(60), fn() => file_get_contents($path));

    //     return $post;
    // }
}
