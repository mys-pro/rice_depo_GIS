<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
    @foreach ($users as $user)
        <div class="col">
            <div class="card border-0 shadow">
                <div class="card-body d-flex flex-column align-items-center p-3">
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <span
                            class="badge bg-opacity-10 {{ $user->status == 1 ? 'text-bg-success text-success' : 'text-bg-danger text-danger' }}">{{ $user->status == 1 ? 'Hoạt động' : 'Khóa' }}
                        </span>

                        <a class="dropdown-item text-danger w-auto" href="{{ route('user.delete', $user->id) }}"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                            <i class="bi bi-trash3 text-danger"></i>
                        </a>
                    </div>
                    <img class="rounded-circle my-3"
                        src="{{ asset(isset($user->image) ? $user->image : 'backend/img/default_avatar.jpg') }}"
                        alt="" width="84px" height="84px">
                    <span class="fw-bold w-100 text-truncate text-center">{{ $user->name }}</span>
                    <span class="text-secondary mb-3">{{ $user->user_catalogue_name }}</span>
                    <a role="button" class="btn btn-outline-success rounded-pill modal-show-btn"
                        href="{{ route('user.detail', $user->id) }}">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $users->links('pagination::bootstrap-5') }}
