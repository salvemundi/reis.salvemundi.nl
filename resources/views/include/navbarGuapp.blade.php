<nav id="TopNavbar" class="navbar navbar-expand-lg navbarText navbarBackground">
    <div class="container removeMargin">
        <a class="navbar-brand" href="/">
            <img class="imgNavbar" src="{{ asset('/images/logo.svg') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i id="hamburgerMenu" class="fa fa-bars"></i>
        </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav justify-content-lg-start">
            <li class="nav-item">
                <a class="nav-link" href="/blogs">Updates / Hints</a>
            </li>
            @if($userIsAdmin)
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Admin</a>
                </li>
            @endif
        </ul>
            <ul class="navbar-nav w-75 d-flex justify-content-end">
            <!-- Right Side Of Navbar -->
                <!-- Authentication Links -->
                <li class="nav-item">
                    @if(session('id'))
                        <a class="nav-link" href="/signout">Logout</a>
                    @else
                        <a class="nav-link" href="/login">Log in</a>
                    @endif
                </li>
            </ul>
      </div>
    </div>
</nav>
