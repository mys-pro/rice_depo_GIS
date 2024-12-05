@include('backend.user.component.breadcrumb')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            @include('backend.user.component.avatar')
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    @include('backend.user.component.tab')
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview">
                            <h5 class="card-title">Chi tiết hồ sơ</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Họ tên</div>
                                <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                                <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Giới tính</div>
                                <div class="col-lg-9 col-md-8">{{ $user->gender == 0 ? 'Nữ' : 'Nam' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Địa chỉ</div>
                                <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Trạng thái</div>
                                <div class="col-lg-9 col-md-8">
                                    <span
                                        class="badge bg-opacity-10 {{ $user->status == 1 ? 'text-bg-success text-success' : 'text-bg-danger text-danger' }}">{{ $user->status == 1 ? 'Hoạt động' : 'Khóa' }}
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nhóm người dùng</div>
                                <div class="col-lg-9 col-md-8">{{ $user_catalogue->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Kho</div>
                                <div class="col-lg-9 col-md-8">{{ isset($warehouse) ? $warehouse->name : '-' }}</div>
                            </div>

                        </div>
                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>
