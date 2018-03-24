<div class="container col-sm-8">
		@if(count($errors))
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $e)
						<li>{{$e}}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>