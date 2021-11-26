<?php

use Illuminate\Support\Str;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Models\Category;
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
//excerpt mean s short extract from something -> take (a short extract) from a text
Route::get(
   '/create',function(){
       $post = new Post;
       $post->category_id = 1;
       $post->title = "Fourth Post";
       $post->slug = Str::slug($post->title);
       $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
       Ut tincidunt rutrum tortor, sed auctor purus faucibus vitae. 
       Donec vehicula vitae mauris ut placerat.Vestibulum sit amet risus 
       dapibus mauris dignissim feugiat at eu tellus. Phasellus ut tempor";
       $post->body = "
       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tincidunt rutrum tortor, sed auctor purus faucibus
    vitae. Donec vehicula vitae mauris ut placerat. Vestibulum sit amet risus dapibus mauris dignissim feugiat at eu
    tellus. Phasellus ut tempor
    quam. In sed mauris sagittis, finibus sem non, hendrerit diam. Morbi sapien justo, ultricies sed diam quis, pretium
    lobortis diam. Nam vestibulum risus libero, ut hendrerit ligula porttitor et. Maecenas vitae velit non lorem tempor
    tempus. Etiam pellentesque,
    turpis nec finibus porta, dui velit ultricies purus, et porta mi libero pretium ex. Aenean quis fringilla est, eget
    commodo nisl. Proin ac dolor mauris. Curabitur malesuada augue sed justo imperdiet bibendum. Phasellus turpis
    sapien, pharetra sit
    amet nulla vel, auctor pharetra diam. Suspendisse interdum enim non nulla dapibus, eget aliquet ante consequat.
    Donec placerat est odio, non dictum diam aliquam et. Integer pulvinar justo sed lorem egestas, a eleifend diam
    commodo. Aliquam sed dui
    iaculis, varius tellus eget, mattis tortor. Aliquam tristique turpis consequat hendrerit accumsan. Mauris sit amet
    massa neque. Suspendisse potenti. Donec sodales ante ante, at congue eros egestas a. Curabitur mattis leo et eros
    pellentesque egestas.
    Aliquam tincidunt nisl ut nulla fringilla, et dictum purus dignissim. Etiam sed nulla magna. Phasellus ut leo id
    arcu dapibus cursus id id nisl. Integer sed diam magna. Morbi suscipit risus nec congue tempor. Quisque auctor lorem
    tellus, sit amet
    volutpat nisl convallis sit amet. Mauris felis dolor, placerat sed efficitur sed, fermentum ac risus. Proin
    faucibus, justo eu facilisis porta, turpis enim fermentum leo, ut tincidunt leo tortor eget sem. Morbi imperdiet ac
    tortor vel dictum. Duis
    a nulla urna. In hac habitasse platea dictumst. Nullam hendrerit vel leo et consequat. Fusce non luctus ligula.
    Fusce enim nulla, tincidunt convallis neque sed, tempor condimentum eros. Suspendisse aliquet tincidunt mauris quis
    ultrices. Nam lobortis
    purus at dignissim viverra. Quisque consequat lorem sed nulla pharetra, id tincidunt dui imperdiet. Interdum et
    malesuada fames ac ante ipsum primis in faucibus. Sed est enim, laoreet ut neque ut, laoreet facilisis metus.
    Quisque venenatis tellus
    accumsan, imperdiet urna sit amet, viverra nisi. Nunc quis pulvinar nunc. Maecenas nisi quam, laoreet in enim id,
    semper semper arcu. Mauris vehicula interdum leo non commodo. Vivamus sed tempor lectus. Donec condimentum nibh
    tortor, eget lacinia
    leo ultricies id. Duis ornare mauris arcu. Fusce dignissim justo sed tincidunt lacinia. Proin eleifend sit amet arcu
    vitae maximus. Curabitur tempor sagittis nunc, ut ornare est dictum quis. Vestibulum mollis id felis sodales
    fermentum. Nullam consequat,
    nulla ut imperdiet sagittis, nisl risus tristique diam, sit amet sodales dui justo at risus. Curabitur sed ex
    tincidunt est imperdiet posuere. Fusce posuere mauris sit amet magna blandit, sit amet viverra libero mattis.
    Curabitur interdum ac dui vitae
    iaculis. Curabitur porttitor neque nec bibendum laoreet. Curabitur justo quam, consectetur eget scelerisque
    malesuada, finibus eget purus. Nunc sed dolor nisi. Aliquam quis diam quis lacus viverra imperdiet. Curabitur
    blandit metus eu finibus auctor.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac maximus ipsum. Etiam interdum turpis ac orci
    pulvinar lobortis. Pellentesque sapien ligula, porttitor non orci ac, aliquam tempor ipsum.
       ";
       dd($post->save());
   } 
);

Route::get('/', function () {
    return view('posts',
    [
        'posts' => Post::all()
    ]);
});

Route::get('test',function(){

    //$cat = Category::find(1)->posts()->get();//can access it as a bethod
    $cat = Category::find(1)->posts;//can access it as a property
    dd($cat);

});

//Route::get('/post/{slug}', [PostController::class,'ver_1'])->where('post','[A-z0-9\_-]+'); //constraint
// Route::get('/post/{slug}', [PostController::class,'ver_2']); //constraint


//https://laravel.com/docs/8.x/routing#customizing-the-default-key-name
Route::get('/posts/{post:slug}', function(Post $post){
    return view('post',[
        'post' => $post,
    ]);
}); //constraint