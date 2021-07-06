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
                <a href="#" class="nav_link active">
                    <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Bookmark</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span>
                </a>
            </div>
        </div>
        <a href="#" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
        </a>
    </nav>
</div>
