    <div class="blog-masthead">
      <div class="container">
        <nav class="nav blog-nav">
          <a class="nav-link {{$a_home or ''}}" href="/">Accueil</a>
          <a class="nav-link {{$a_posts or ''}}" href="/">Posts</a>
          @can('editor')
          <a class="nav-link {{$a_create or ''}}" href="/post/create">Créer un Post</a>
          <a class="nav-link" href="/post/mesposts">Mes Posts</a>
          @endcan
          @if (Auth::check())

             <a class="nav-link" href="/logout">Se déconnecter</a>

             <a class="nav-link ml-auto" href="/user/{{Auth::user()->id}}">{{Auth::user()->name}}
             @foreach(Auth::user()->role as $role)
                <b style="color:#EFEFEF;">[{{$role->name}}]</b>
              @endforeach
              </a>

           @else
           <a class="nav-link" href="/register">S'inscire</a>
           <a class="nav-link ml-auto" href="/login">Se Connecter</a>
           @endif
          @can('admin')
            <a class="nav-link ml-auto" href="/admin">Admin</a>
           @endcan


        </nav>
      </div>
    </div>
    
