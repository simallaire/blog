@component('mail::message')
# Bienvenue

Merci de vous avoir inscris, {{$user->name}}!

@component('mail::button', ['url' => 'blog.test/'])
Commencez à naviguer! 
@endcomponent

@component('mail::panel', ['url' => ''])
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, ab cum sequi facere deserunt, harum ullam. Omnis pariatur distinctio numquam, placeat, suscipit optio porro in, voluptate eaque iste nobis totam.
@endcomponent


Merci,<br>
{{ config('app.name') }}
@endcomponent
