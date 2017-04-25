<div class="blog-masthead">

  <div class="container">

    <nav class="nav blog-nav">

      <a class="nav-link active" href="#">Hello</a>

      <a class="nav-link" href="#">Wie funktionierts?</a>





      @if (Auth::check())
      	
      	<a class="nav-link ml-auto" href="/admin/dashboard">{{ Auth::user()->first_name . " " . Auth::user()->last_name }}</a>

	    <a class="nav-link" href="/logout">Logout</a>

      @else

      	<a class="nav-link ml-auto" href="/register">Registrieren</a>

	    <a class="nav-link" href="/login">Login</a>      

      @endif

    </nav>

  </div>

</div>