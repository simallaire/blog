@extends('layouts.master')

@section('content')
@include('layouts.header')
<div class="container">
	<div class="container">
    <h3>Gérer les publications</h3>
	@if($deleted)
	<h4>Publications supprimés</h4>
	@endif
    @foreach ($posts as $post)
    	<hr/>
    	<div style="font-size:1.2em;color:orange;float:right;margin:auto;display:inline-block;">
	    	@if(!$deleted)
		    	<form action="/posts/{{$post->id}}" style="display:inline-block;" method="POST">
		    		{{csrf_field()}}
		    		<input type="hidden" name="_method" value="DELETE">
			    	<button type="submit" class="btn btn-danger">
			    		<i class="fa fa-trash"> </i>
		    		</button>
		    	</form>
	    	@else
		    	<form action="/posts/{{$post->id}}/restore" style="display:inline-block;" method="POST">
		    		{{csrf_field()}}
					<input type="hidden" name="_method" value="PATCH">
			    	<button type="submit" class="btn btn-light">
			    		<i class="fa fa-undo"> </i>
		    		</button>
		    	</form>
	    	@endif
	    	<form action="/posts/{{$post->id}}/edit" style="display:inline-block;" method="GET">
		    	<button type="submit" class="btn btn-success">
		    		<i class="fa fa-pencil-alt"> </i>
		    	</button>
	    	</form>
    	</div>
    	<p>Titre: <b>{{$post->title}}</b></p>
    	<p>{{$post->body}}</p>
    	<p>Par: <i>{{$post->user->name}}</i>
		@foreach($post->user->role as $role)
		[{{$role->name}}]
		@endforeach
    	</p>
    	<p>Date: {{$post->created_at->diffForHumans()}}</p>
    	
    @endforeach
</div>
</div>
@endsection