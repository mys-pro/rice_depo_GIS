<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.index') ? '' : 'collapsed' }}"
        href="{{ route('dashboard.index') }}">
        <i class="bi bi-map"></i>
        <span>Bản đồ</span>
    </a>
</li><!-- End Dashboard Nav -->

<li class="nav-heading">Kho lúa</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('warehouse.index') ? '' : 'collapsed' }}"
        href="{{ route('warehouse.index') }}">
        <i class="bi bi-house"></i>
        <span>Quản lý kho lúa</span>
    </a>
</li><!-- End Warehouse Nav -->

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('rice.index') ? '' : 'collapsed' }}" href="{{ route('rice.index') }}">
        <i class="bi bi-archive"></i>
        <span>Quản lý lúa</span>
    </a>
</li><!-- End Rice Nav -->

<li class="nav-item">
    <a class="nav-link collapsed" href="">
        <i class="bi bi-arrow-bar-down"></i>
        <span>Nhập kho</span>
    </a>
</li><!-- End Import Nav -->

<li class="nav-item">
    <a class="nav-link collapsed" href="">
        <i class="bi bi-arrow-bar-up"></i>
        <span>Xuất kho</span>
    </a>
</li><!-- End Export Nav -->

<li class="nav-heading">Đối tượng</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('user.index') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
        <i class="bi bi-person"></i>
        <span>Quản lý nhân viên</span>
    </a>
</li><!-- End User Nav -->

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('customer.index') ? '' : 'collapsed' }}" href="{{ route('customer.index') }}">
        <i class="bi bi-people"></i>
        <span>Quản lý khách hàng</span>
    </a>
</li><!-- End Customer Nav -->