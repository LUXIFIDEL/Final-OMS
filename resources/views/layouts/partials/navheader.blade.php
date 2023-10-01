<div class="nav-header" style="z-index:999999;">
    <a href="" class="text-dark brand-logo">
        <img src="{{asset('/image/Moonride-Logo.jpg')}}" class="rounded-circle" alt="" height="70">
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<div class="header" style="z-index:999998;">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        @yield('title')
                    </div>
                </div>
                
                <ul class="navbar-nav header-right">
                    @if(auth()->user()->role == 'client')
                    <li class="nav-item">
                        <livewire:megaphone></livewire:megaphone>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-md rounded-circle p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>