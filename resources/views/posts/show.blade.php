<?php $a_posts = 'active' ?>
@extends('layouts.master')
@section('content')
@include('layouts.header')
  <div class="container">
    <div class="row">

      <div class="col-sm-8 blog-main">
              <div class="container">
      @if($post->picture_src != 'null')

      <img style="max-height:400px;"  src="/img/{{$post->picture_src}}" alt="Main Picture">
   
      @endif
    <h1> {{ $post->title }}    </h1>
          <p>Par : <b>{{$post->user->name}}</b></p>

    {{$post->body}}

 
      <hr/>
      @if($post->picture_src != 'null')
    </div>
      @endif
        <nav class="nav">
            <a href="" class="nav-link">
              {{-- Si Admin ou Editeur de ce post --}}
              @if(Gate::check('admin')||Gate::check('ownPost',$post))
                {{-- @can('admin|update',$post) --}}
                <form method="get" action="/posts/{{$post->id}}/edit">
                  <button class="btn btn-primary">
                      <i class="fa fa-pencil-alt"> </i>
                  </button>
               </form>
              @endif
          </a>

          <a href="" class="nav-link">
            @if(Gate::check('admin')||Gate::check('ownPost',$post))
                @can('ownPost',$post)
                  <form method="POST" action="/post/{{$post->id}}">
                @elsecan('admin')
                  <form method="POST" action="/posts/{{$post->id}}">
                @endcan
                <input type="hidden" name="_method" value="DELETE">
                {{csrf_field()}}
                <button class="btn btn-primary">
                    <i class="fa fa-trash"> </i>  
                </button>
                
              </form>
            @endif
          </a>
        </nav>
        <ul class="list-group">
        @foreach ($comments as $comment)

         <li class="list-group-item">

           @can('admin')
            <form method="POST" id="comform" action="/comments/{{$comment->id}}/delete">
              {{csrf_field()}}
              <input type="text" name="commentid" style="display:none;">
              <button style="opacity:0.7;"><i id="delcom" class="far fa-trash-alt"></i></button>
            </form>
           @endcan
            <strong>
              {{$comment->user->name}}
              </strong>
                   <i>({{$comment->created_at->diffForHumans()}})</i>
            <?php $adminOrEditor = false; ?>
           
             @foreach($comment->user->role as $role) {{--Trouve si l'auteur du commentaire est un admin ou un editor--}}
              @if($role->id == 1){{--Admin--}}
                <q style="color:blue;margin-left:5em;">{{$comment->body}}</q>
                <?php $adminOrEditor = true; ?>
                @break
              @endif
              @if($role->id == 2) {{--Editor--}}
                <q style="color:lightblue;margin-left:5em;">{{$comment->body}}</q>
                <?php $adminOrEditor = true; ?>
                @break
              @endif
             @endforeach
             @if(!$adminOrEditor)  {{--Si l'auteur du commentaire n'est pas un admin ou un editor--}}
              <q style="margin-left:5em;">{{$comment->body}}</q> 
             @endif
              

          </li>

   
    @endforeach

  <hr/>
@if(Auth::user())
  @cannot('guest')
  <form class="" method="POST" action="/posts/{{$post->id}}/comments">  
  <div class="card">
    <div class="card-block">

            {{ csrf_field() }}
      <div class="form-group">      
        <input type="text" name="body" placeholder="Écrivez un commentaire.." required class="form-control"></div>
      <div class="form-group">  <input type="submit" class="form-control" value="Envoyer"></div>

    </div>
  </div>
      @include('layouts.error')
      </form>
    @endcannot
    @endif
    </ul>
  </div>
    </div>
  </div>
@endsection
