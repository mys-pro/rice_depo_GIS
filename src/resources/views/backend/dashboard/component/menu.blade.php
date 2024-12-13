<li class="nav-item">
    <a class="nav-link {{ $page == 'dashboard' ? '' : 'collapsed' }}" href="{{ route('dashboard.index') }}">
        <i class="bi bi-map"></i>
        <span>Bản đồ</span>
    </a>
</li><!-- End Dashboard Nav -->

<li class="nav-heading">Kho lúa</li>

@if (auth()->user()->user_catalogue_id == 1)
    <li class="nav-item">
        <a class="nav-link {{ $page == 'warehouse' ? '' : 'collapsed' }}" href="{{ route('warehouse.index') }}">
            <i class="bi bi-house"></i>
            <span>Quản lý kho lúa</span>
        </a>
    </li><!-- End Warehouse Nav -->

    <li class="nav-item">
        <a class="nav-link {{ $page == 'rice' ? '' : 'collapsed' }}" href="{{ route('rice.index') }}">
            <i class="bi bi-archive"></i>
            <span>Quản lý lúa</span>
        </a>
    </li><!-- End Rice Nav -->
@endif

<li class="nav-item">
    <a class="nav-link {{ $page == 'import' ? '' : 'collapsed' }}" href="{{ route('import.index') }}">
        <i class="bi bi-arrow-bar-down"></i>
        <span>Quản lý nhập kho</span>
    </a>
</li><!-- End Import Nav -->

<li class="nav-item">
    <a class="nav-link {{ $page == 'export' ? '' : 'collapsed' }}" href="{{ route('export.index') }}">
        <i class="bi bi-arrow-bar-up"></i>
        <span>Quản lý xuất kho</span>
    </a>
</li><!-- End Export Nav -->

<li class="nav-heading">Đối tượng</li>

@if (auth()->user()->user_catalogue_id == 1)
    <li class="nav-item">
        <a class="nav-link {{ $page == 'user' ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
            <i class="bi bi-person"></i>
            <span>Quản lý nhân viên</span>
        </a>
    </li><!-- End User Nav -->
@endif

<li class="nav-item">
    <a class="nav-link {{ $page == 'customer' ? '' : 'collapsed' }}" href="{{ route('customer.index') }}">
        <i class="bi bi-people"></i>
        <span>Quản lý khách hàng</span>
    </a>
</li><!-- End Customer Nav -->
