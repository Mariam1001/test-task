<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Heading (Addons)-->
                <div class="sidenav-menu-heading">Dashboard</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ url('/user/accounts') }}">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    User Accounts
                </a>

                <div class="sidenav-menu-heading">Posts</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="{{ url('user/posts') }}">
                    <div class="nav-link-icon"><i data-feather="edit"></i></div>
                    Posts
                </a>
            </div>
        </div>
    </nav>
</div>
