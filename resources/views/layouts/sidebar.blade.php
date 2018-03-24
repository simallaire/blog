        <div class="col-sm-3 offset-sm-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
          <div class="sidebar-module">
            
            <ol class="list-unstyled">
            <li><a href="/about">À propos</a></li>
            <li><a href="mailto:sp.allaire93@gmail.com">Contacts</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">

            @foreach ($archives as $archive)
            <li><a href="?month={{$archive->month.'&year='.$archive->year}}">{{$archive->month. ' ' .$archive->year}}</a></li>

            @endforeach
            </ol>

          </div>
        </div><!-- /.blog-sidebar -->
        </div>