@component('mail::message')
# Notification

Bonjour, {{$user->name}}!

@component('mail::panel', ['url' => 'http://blog.test/'])
Un utilisateur a récemment commenté votre publication nommé:
#{{$post->title}}
@endcomponent

@component('mail::button', ['url' => 'http://blog.test/posts/'.$post->id])
Accéder à la publication
@endcomponent

Au plaisir,<br>
{{ config('app.name') }}
@endcomponent
