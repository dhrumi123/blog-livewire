<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light"
                    src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                    src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('user.dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="anchor"></i><span>General management</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="submenu-title" href="{{ route('admin.role') }}">Roles<span class="sub-arrow"><i
                                            class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li> <a class="submenu-title" href="{{ route('admin.permission') }}">Permissions<span class="sub-arrow"><i
                                            class="fa fa-chevron-right"></i></span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="anchor"></i><span>Category management</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="submenu-title" href="{{ route('admin.categories') }}">Categories<span class="sub-arrow"><i
                                            class="fa fa-chevron-right"></i></span></a>
                            </li>
                            <li> <a class="submenu-title" href="{{ route('admin.subcategories') }}">Sub-categories<span class="sub-arrow"><i
                                            class="fa fa-chevron-right"></i></span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('admin.users') }}"><i
                                data-feather="home"></i><span>User management</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('admin.blogs') }}"><i
                                    data-feather="home"></i><span>Blogs</span></a></li>
                    {{-- <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('admin.subadmins') }}"><i --}}
                                    {{-- data-feather="home"></i><span>Sub Admin management</span></a></li> --}}
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
