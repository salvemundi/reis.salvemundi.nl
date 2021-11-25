<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="/dashboard" class="nav_logo">
                <img class="imgNavbar2" src="{{ asset('images/logo.svg') }}" width="40" height="40"/> <span class="nav_logo-name">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <div class="nav_list">
                <a id="dashboard" href="/dashboard" class="nav_link">
                    <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span>
                </a>
                <a id="participants" href="/participants" class="nav_link">
                    <i class='bx bx-user nav_icon'></i> <span class="nav_name">Deelnemers</span>
                </a>
                <a id="add" href="/add" class="nav_link">
                    <i class='bx bi bi-plus-circle circlePlus'></i> <span class="nav_name">Voeg toe</span>
                </a>
                <a id="test" href="/test" class="nav_link">
                    <i class='fas fa-virus virus'></i> <span class="nav_name">Covid tests</span>
                </a>
                <a href="/bus" class="nav_link">
                    <i class='fas fa-bus bus'></i> <span class="nav_name">Bus</span>
                </a>
            </div>
        </div>
        <a href="/signout" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Log uit</span>
        </a>
    </nav>
</div>
