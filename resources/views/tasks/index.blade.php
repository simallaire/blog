@foreach ($tasks as $task)

<li><a href="{{$task->id}}">{{$task->body}}</a></li>

@endforeach