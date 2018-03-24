@extends('layouts.master')

@section('content')
@include('layouts.header')
<div class="container">
	<h3>Section Admin</h3>
	<hr>
	<h5>Tableau de bord</h5>
	
	<div class="content">
		<ul class="list-group">
			<li class="list-group-item"><a href="/admin/posts">Gérer les posts</a></li>
			<li class="list-group-item"><a href="/admin/deletedposts">Gérer les posts supprimés</a></li>
			<li class="list-group-item"></li>
		</ul>
	</div>


@endsection
