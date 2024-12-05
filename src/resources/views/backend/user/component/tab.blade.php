<ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->routeIs('user.detail') ? 'active' : '' }}"
            href="{{ route('user.detail', $user->id) }}">
            Tổng quan
        </a>
    </li>

    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->routeIs('user.edit') ? 'active' : '' }}"
            href="{{ route('user.edit', $user->id) }}">
            Chỉnh sửa
        </a>
    </li>

    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->routeIs('user.changePass') ? 'active' : '' }}"
            href="{{ route('user.changePass', $user->id) }}">
            Đổi mật khẩu
        </a>
    </li>
</ul>
