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
                        <a href="" class="btn btn-md rounded-circle btn-warning p-1">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo3/dist/../src/media/svg/icons/General/Notifications1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                                    <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </a>
                    </li>
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