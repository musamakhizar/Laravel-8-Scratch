@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-12 p-5"> 
              <article>
                <h1>{{$post->title}}</h1>
                {!!$post->body!!}
                <a href="/">Go Back</a>
              </article>
          </div>
      </div>
  </div>
@endsection