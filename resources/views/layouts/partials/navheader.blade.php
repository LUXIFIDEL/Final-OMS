<div class="nav-header">
    <a href="{{route('home')}}" class="text-dark brand-logo">
        <img src="{{asset('/image/Moonride-Logo.jpg')}}" class="rounded-circle" alt="" height="70">
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        @yield('title')
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item">
                        <form action="" method="GET">
                            <div class="input-group search-area">
                                <input type="text" class="form-control" name="search" value="" placeholder="Search here...">
                                <span class="input-group-text"><a><i class="flaticon-381-search-2"></i></a></span>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>