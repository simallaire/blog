<?php $a_create = 'active';
try{
	$post;
	if(is_null($post)){
		$post = new App\Post;
	}
}catch(Exception $ex){}
 ?>


@extends('layouts.master')

@section('content')
@include('layouts.header')


<div class="container">
	<div class="row">
	<div class="col-sm-8 blog-main">
	@if ($post->title=="")
		<form method="POST" action="/posts">
	@else
		<form method="POST" action="/posts/{{$post->id}}">
			<input type="hidden" name="_method" value="PATCH">
	@endif	
		{{ csrf_field() }}

		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" name="title" value="{{$post->title}}" required class="form-control" id="title">

		</div>

		<div class="form-group">

			<label for="body">Body:</label>
			<textarea id="body" name="body" required class="form-control">{{$post->body}} </textarea>

		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Publish</button>
		</div>
		@include('layouts.error')
	</form>

	
</div>


@endsection