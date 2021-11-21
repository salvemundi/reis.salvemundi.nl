<header class="header" id="header">
  <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
</header>
<div class="l-navbar" id="nav-bar">
  <nav class="nav">
      <div>
          <a href="/signup" class="nav_logo">
              <img class="imgNavbar" src="{{ asset('images/logo.svg') }}" width="40" height="40"/> <span class="nav_logo-name">{{ config('app.name', 'Laravel') }}</span>
          </a>
          <div class="nav_list">
              <a id="dashboard" href="/signup" class="nav_link">
                <i style="transform: scale(1.5);" class="bx bi bi-clipboard-check"></i><span class="nav_name mr-2"> Signup</span>
              </a>
              <a id="salvemundi" href="https://salvemundi.nl" target="https://salvemundi.nl" class="nav_link">
                <img src="{{ asset('images/logo.svg') }}" class="samuIcon" width="30px" height="30px" style="margin-left: -7px;"/> <span class="nav_logo-name">Salve Mundi</span>
            </a>
          </div>
      </div>
  </nav>
</div>
