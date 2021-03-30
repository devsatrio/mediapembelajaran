<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{url('/home')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        @if(Auth::user()->level =='Super Admin')
        <li class="nav-item">
            <a href="{{url('/admin')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Admin
                </p>
            </a>
        </li>
        @endif
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th-large"></i>
                <p>
                    Konten
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('menu')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('submenu')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Submenu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('halaman')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Halaman</p>
                    </a>
                </li>
            </ul>
        </li>
        <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-paint-brush"></i>
                <p>
                    Artikel
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('kategori-artikel')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('artikel')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Artikel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('komentar')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Komentar</p>
                    </a>
                </li>
            </ul>
        </li> -->
        <!-- <li class="nav-item">
            <a href="{{url('/galeri')}}" class="nav-link">
                <i class="nav-icon fas fa-images"></i>
                <p>
                    Galeri
                </p>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="{{url('/slider')}}" class="nav-link">
                <i class="nav-icon fas fa-image"></i>
                <p>
                    Slider
                </p>
            </a>
        </li>
        @if(Auth::user()->level =='Super Admin')
        <li class="nav-item">
            <a href="{{url('/setting-web')}}" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Setting Web
                </p>
            </a>
        </li>
        @endif
    </ul>
</nav>