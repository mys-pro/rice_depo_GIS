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
                        <div class="tab-pane fade profile-edit pt-3 active show">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Profile Edit Form -->
                            <form method="POST" action="{{ route('user.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($self)
                                    <div class="row g-3 mb-3">
                                        {{-- Begin: User detail avatar --}}
                                        <div class="col-12">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <div class="user-avatar mb-3">
                                                    <img src="{{ asset(isset($user->image) ? $user->image : 'backend/img/default_avatar.jpg') }}"
                                                        alt="avatar">
                                                    <label class="user-avatar-edit" for="user-image"><i
                                                            class="bi bi-camera-fill"></i></label>
                                                    <input type="file" class="input-image d-none" id="user-image"
                                                        name="image" accept="image/*">
                                                </div>
                                            </div>
                                        </div> {{-- End: User detail avatar --}}
                                    </div>
                                @endif

                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" id="user-name" name="name"
                                                placeholder="Tên người dùng" value="{{ $user->name }}">
                                            <label for="user-name" class="form-label fw-semibold">Tên người dùng
                                                <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" id="user-email" name="email"
                                                placeholder="email" value="{{ $user->email }}">
                                            <label for="user-name" class="form-label fw-semibold">Email <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                @if (!$self)
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6 col-12">
                                            <div class="form-outline">
                                                <select class="form-select" id="user-user_catalogue_id"
                                                    name="user_catalogue_id">
                                                    @foreach ($userCatalogues as $userCatalogue)
                                                        <option value="{{ $userCatalogue->id }}"
                                                            {{ $user->user_catalogue_id == $userCatalogue->id ? 'selected' : '' }}>
                                                            {{ $userCatalogue->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="user-user_catalogue_id">Nhóm người dùng</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <div class="form-outline">
                                                <select class="form-select" id="user-status" name="status">
                                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>
                                                        Khóa
                                                    </option>
                                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                                                        Hoạt động
                                                    </option>
                                                </select>
                                                <label for="user-status">Trạng thái</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row g-3 mb-3">
                                    <div class="col-sm-4 ol-12">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" id="user-phone" name="phone"
                                                placeholder="Số điện thoại" value="{{ $user->phone }}">
                                            <label for="user-phone" class="form-label fw-semibold">Số điện thoại
                                                <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-12">
                                        <div class="form-outline">
                                            <select class="form-select" id="user-gender" name="gender">
                                                <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>
                                                    Nữ
                                                </option>
                                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>
                                                    Nam
                                                </option>
                                            </select>
                                            <label for="user-gender">Giới tính</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-12">
                                        <div class="form-outline">
                                            <input type="date" class="form-control" id="user-birthday"
                                                name="birthday" placeholder="Ngày sinh" value="{{ $user->birthday }}">
                                            <label for="user-birthday" class="form-label fw-semibold">
                                                Ngày sinh
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                @if (!$self)
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <div class="form-outline">
                                                <select class="form-select use-select2" id="user-warehouse_id"
                                                    name="warehouse_id">
                                                    <option value="0">Chọn kho lúa</option>
                                                    @foreach ($warehouses as $warehouse)
                                                        <option value="{{ $warehouse->id }}"
                                                            {{ $user->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                                            {{ $warehouse->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="user-warehouse_id">Kho <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <div class="form-outline">
                                            <input type="text" class="form-control" id="user-address"
                                                name="address" placeholder="Địa chỉ" value="{{ $user->address }}">
                                            <label for="user-address" class="form-label fw-semibold">Địa chỉ
                                                <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>

        </div>
    </div>
</section>
