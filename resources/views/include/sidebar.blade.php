<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <img class="imgNavbar" src="{{ asset('images/logo.svg') }}" width="40" height="40"/> <span class="nav_logo-name">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <div class="nav_list">
                <a id="dashboard" href="/dashboard" class="nav_link">
                    <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span>
                </a>
                <a id="participants" href="/participants" class="nav_link">
                    <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span>
                </a>
                <a id="add" href="/add" class="nav_link">
                    <i class='bx bi bi-plus-circle circlePlus'></i> <span class="nav_name">Add</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='fas fa-virus virus'></i> <span class="nav_name">Covid</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='fas fa-bus bus'></i> <span class="nav_name">Bus</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span>
                </a>
            </div>
        </div>
        <a href="/signout" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
        </a>
    </nav>
</div>
