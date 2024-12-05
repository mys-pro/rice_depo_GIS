<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
    <img src="{{ asset(isset($currentUser->image) ? $currentUser->image : 'backend/img/default_avatar.jpg') }}"
        alt="Profile" class="rounded-circle">
</a><!-- End Profile Iamge Icon -->

<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
    <li class="dropdown-header">
        <h6>{{ $currentUser->name }}</h6>
        <span>{{ $currentUser->user_catalogue_name }}</span>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>

    <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('user.detail', $currentUser->id) }}">
            <i class="bi bi-person"></i>
            <span>Thông tin của tôi</span>
        </a>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>

    <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('user.detail', $currentUser->id) }}">
            <i class="bi bi-gear"></i>
            <span>Cài đặt tài khoản</span>
        </a>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>

    <li>
        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span>Cần giúp đỡ?</span>
        </a>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>

    <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('auth.logout') }}">
            <i class="bi bi-box-arrow-right"></i>
            <span>Đăng xuất</span>
        </a>
    </li>

</ul><!-- End Profile Dropdown Items -->
