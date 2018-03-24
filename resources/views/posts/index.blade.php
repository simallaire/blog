<?php $a_home = 'active'; ?>
<?php $a_posts = 'active'; ?>
@extends('layouts.master')
@section('content')

@include('layouts.header')
  

<div class="container">

  <div class="row">

  <div class="col-sm-8 blog-main">

  @foreach ($posts as $post)
    <div class="blog-post">
      @if($post->picture_src != 'null')
      <img style="max-height:200px;"  src="../../img/{{$post->picture_src}}" alt="Card image cap">
      @endif
      <p class="card-text">
      <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>

      <p>{{$post->user->name}} <b>{{$post->created_at->diffForHumans() }}</b></p>

      <?php ?>
      @if(strlen($post->body)>100)
      {{substr($post->body,0,99)}}...</p>
      @else
      {{$post->body}}
      @endif
    </div>
    @endforeach

  </div>



  @include('layouts.sidebar')
@endsection
