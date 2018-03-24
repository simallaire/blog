
@extends('layouts.master')

@section('content')


@include('layouts.header')
<div class="container">

<div class="content">
    <h3>{{$USER->name}}
      @foreach($USER->role as $role)
          <i style="font-size:smaller;">[{{$role->name}}]</i>
      @endforeach
   </h3>
    @if($own)
        <p>Votre courriel : {{$USER->email}}</p>
      
      <div style="font-size:1.2em;float:right;""><button id="btn-show-form" class="btn btn-light"><i  class="fa fa-pencil-alt"></i></button></div>
    @endif
     <div class="panel-body">
      @if($USER->picture_src!='null')
        <img  style="max-height:200px;"  src="../../img/{{$USER->picture_src}}" alt="Card image cap">
      @endif

      <p>
        {{$USER->description}} 
      </p>
   </div>
 @if($own)
    <div class="profile-form" style="display:none;" id="profile-form">
      <form method="POST" class="form" action="/user/{{$USER->id}}/profile" enctype="multipart/form-data">
          <input type="hidden" name="userid" value="{{$USER->id}}">
        {{csrf_field()}}
          @foreach($USER->role as $roles)
              @if($roles->id == 2)
              <label for="emailnotif">Recevoir Notifications par Email</label>
              <select class="form-control" name="emailnotif">
                  <option value="1" @if($USER->emailnotif==1) selected="selected" @endif>Oui</option>
                  <option value="0" @if($USER->emailnotif==0) selected="selected" @endif >Non</option>
              </select>
              @endif
          @endforeach
                  <br/>
        <label for="image">Picture URL</label>
        <input type="file" class="form-control" placeholder="Entrez un URL  " name="image" value="{{$USER->picture_src}}">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" placeholder="Ajoutez une brève description de vous-même" id="textarea" cols="30" rows="10">{{$USER->description}}</textarea>
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
      </form>
    </div>
    @include('layouts.error')
  @endif


</div>
<div class="content">
  @if(count($posts))
    <h2>
      @if($own)
          Vos publications:
      @else 
          Ses publications:
      @endif  
    </h2>
    
    @foreach ($posts as $post)
    <div class="blog-post">
      @if($post->picture_src!='null')
        <img  style="max-height:200px;"  src="../../img/{{$post->picture_src}}" alt="Card image cap">
      @endif
      <p class="card-text">
        <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
      </p>
      <p>
        {{$post->user->name}} le: {{$post->created_at->toDateTimeString() }}</p>

        {{substr($post->body,0,100)}}...
      </p>

      @foreach($post->comments() as $comment)
        <div class="col-sm-5">
          <div class="panel panel-default">
            <div class="panel-heading">

              <strong>{{$comment->user->name}}</strong> <span class="text-muted">{{$comment->created_at}}</span>
            </div>
            <div class="panel-body">
              {{$comment->body}}
            </div><!-- /panel-body -->
          </div>
         </div>
      @endforeach
    </div>
    @endforeach
  @endif

</div>
<hr>
@if($own)
<?php $last=""; ?>    
  <div class="container">

    @if(count($result))
      <h4>Les derniers commentaires sur vos publications</h4>
      @foreach($result as $comment)
      @if($comment->post->id != $last)
      {{$comment->post->id}}
      <div class="form-check" style="float:right;margin-top:2.2em;">
        <button id="{{$comment->id}}" class="btn btn-light read-button">
         <label class="form-check-label" for="{{$comment->id}}">
            <input class="form-check-input" type="checkbox" {{ $comment->read === 1 ? 'checked' : '' }} id="{{$comment->id}}" disabled>
              Lu
            </label>
          </button>  
          </div>
        <form class="{{$comment->id}}" style="margin:10px 0 10px 0;"  action="/comments/{{$comment->id}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">

        <div id="{{$comment->id}}" class="blog-post comment-holder" style="background-color:#F0F1F3;">
          <h5 class="card-text"><a href="/posts/{{$comment->post->id}}">{{$comment->post->title}}</a></h5>
              <div class="col-sm-5">
                <div class="panel panel-default">
                  <div class="panel-heading">
          
                    <strong>{{$comment->user->name}}</strong> le <span class="text-muted">{{$comment->created_at}}</span> a écrit
                  </div>
                  <div class="panel-body">
                    {{$comment->body}}
                  </div><!-- /panel-body -->
                </div>
             </div>
           </div>
      </form>
      @endif
      
      @endforeach
    @endif
  @endif
</div>

@endsection
