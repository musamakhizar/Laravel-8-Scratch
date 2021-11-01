@extends('layouts.app')

  @section('content')
    <div class="container">
      <div classs="row">
          <div class="col-md-12 col-sm-12"> 
            @foreach ($posts as $post)
              
                <div class="row p-5">
                  <div class="col-md-12">
                    <article>  
                  
                      <a href="/post/{{$post->slug}}">
                        <h1>{{$post->title}}</h1>
                      </a>
                      {!! $post->excerpt !!}
                    </article>

                  </div>
                </div>
                  
                

                <hr>
              @endforeach
          
          </div>
      </div>
    </div>



  @endsection

