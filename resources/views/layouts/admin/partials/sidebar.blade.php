<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i> Dashboard
                    </a>
                </li>
                
                <li class="app-sidebar__heading">User & Roles</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i> User & Roles <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('role.index') }}">
                                <i class="metismenu-icon"></i>Roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.index') }}">
                                <i class="metismenu-icon"></i>Users
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="app-sidebar__heading">Services</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>Services <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('service.index') }}">
                                <i class="metismenu-icon"></i> All Service
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('service.create') }}">
                                <i class="metismenu-icon"></i> Add Service
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('department.index') }}">
                                <i class="metismenu-icon"></i> Departmets
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category.index') }}">
                                <i class="metismenu-icon"></i> Categories
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tag.index') }}">
                                <i class="metismenu-icon"></i> Tags
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="metismenu-icon"></i> Filter <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul class="mm-collapse" style="height: 7.48px;">
                                <li>
                                    <a href="{{ route('filterProfile.index') }}">
                                        <i class="metismenu-icon"></i> Filter Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('filter.index') }}">
                                        <i class="metismenu-icon"></i> Filter
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- <li class="app-sidebar__heading">Catalog</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>Catalog <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="">
                                <i class="metismenu-icon"></i>Pages
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="metismenu-icon"></i>Menus
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="metismenu-icon"></i>Slider
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="metismenu-icon"></i>News
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="metismenu-icon"></i>Media
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>