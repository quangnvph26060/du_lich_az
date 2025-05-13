<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a target="_blank" style="width: 90%;" href="https://sgomedia.vn/" class="logo">
                <img src="{{ asset('backend/SGO VIET NAM (1000 x 375 px).png') }}" alt="navbar brand"
                    class="navbar-brand img-fluid" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ activeMenu('admin.dashboard') }}">
                    <a href="{{ route('admin.dashboard') }}" class="collapsed">
                        <i class="fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li class="nav-item {{ activeMenu('admin.catalogues.index') }}">
                    <a href="{{ route('admin.catalogues.index') }}" class="collapsed">
                        <i class="fas fa-chart-line"></i>
                        <p>Danh mục bài viết</p>
                    </a>
                </li>

                <li class="nav-item {{ activeMenu('admin.keywords.index') }}">
                    <a href="{{ route('admin.keywords.index') }}" class="collapsed">
                        <i class="fa-solid fa-key"></i>
                        <p>Danh mục từ khóa</p>
                    </a>
                </li>

                <li class="nav-item {{ activeMenu('admin.tags.index') }}">
                    <a href="{{ route('admin.tags.index') }}" class="collapsed">
                        <i class="fa-solid fa-tags"></i>
                        <p>Danh mục tag</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" class="has-children" href="#blogs">
                        <i class="fas fa-newspaper"></i>
                        <p>Bài viết</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="blogs">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ activeMenu('admin.blogs.index') }}">
                                <a href="{{ route('admin.blogs.index') }}">
                                    <span class="sub-item">Danh sách bài viết</span>
                                </a>
                            </li>
                            <li class="nav-item {{ activeMenu('admin.blogs.create') }}">
                                <a href="{{ route('admin.blogs.create') }}">
                                    <span class="sub-item">Thêm bài viết</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item  {{ activeMenu('admin.config.index') }}">
                    <a href="">
                        <i class="fas fa-cogs"></i>
                        <p>Cấu hình</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
