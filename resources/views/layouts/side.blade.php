@auth
    <aside class="main-sidebar sidebar-dark-primary elevation-4 " style="height: 100vh">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-panel ">
                <div class=" mb-2 mt-2  d-flex justify-content-center">
                    <img style="width: 80%;height: 100%;" src="{{ asset('public/uploads/background/user.jpg') }}"
                        class="  img-circle elevation-2" alt="User Image">
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Bảng điều khiển
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Admin</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Quản lý
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @role('admin')
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản lý người dùng</p>
                                    </a>
                                </li>
                            @endrole
                            <li class="nav-item">
                                <a href="{{ route('truyen_check.data') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Phê duyệt truyện</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('chapter_check.data') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Phê duyệt chapter</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">Quản lý</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Danh mục
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('danhmuc.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm danh mục</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('danhmuc.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách danh mục</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Thể loại
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('theloai.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm thể loại</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('theloai.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách thể loại</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Truyện
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('truyen.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm truyện</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('truyen.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách truyện</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Chapter
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('chapter.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm chapter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('chapter.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách chapter</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <hr style="color: white">
                    <li class="nav-item " style="">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                            <button style="color: white" type="submit" class="nav-link">
                                <p>Đăng xuất</p>
                            </button>
                        </form>
                    </li>
                    <hr style="color: white">
                </ul>
            </nav>
        </div>
    </aside>
@endauth
