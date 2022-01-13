<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">星月文旅</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>後台管理系統</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    

    <!-- Nav Item - Pages Collapse Menu -->
    @guest
                        
    @else    
    <li class="nav-item">
        <a class="nav-link" href="{{route('news.index')}}"><i class="fas fa-fw fa-cog"></i>最新消息</a>
    </li>                        
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" href="#"><i class="fas fa-fw fa-cog"></i>房間</a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('room-types.index')}}">房間類別管理</a>
            <a class="dropdown-item" href="{{route('rooms.index')}}">房間管理</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('carousels.index')}}"><i class="fas fa-fw fa-cog"></i>輪播圖片和Slogan管理</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('feedbacks.index')}}"><i class="fas fa-fw fa-cog"></i>評價管理</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('features.index')}}"><i class="fas fa-fw fa-cog"></i>園區特色管理</a>
    </li>
    @endguest
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>