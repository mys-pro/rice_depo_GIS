@include('backend.user.component.breadcrumb')
<section class="section">
    <div class="card">
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ $form }}">
                @csrf
                {{-- Begin: Create and store form --}}
                <div class="row g-3">
                    <div class="col-lg-6 col-12">
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="user-name" name="name"
                                        placeholder="Tên người dùng" value="{{ old('name') }}">
                                    <label for="user-name" class="form-label fw-semibold">Tên người dùng <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="user-email" name="email"
                                        placeholder="email" value="{{ old('email') }}">
                                    <label for="user-name" class="form-label fw-semibold">Email <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-12">
                                <div class="form-outline">
                                    <input type="password" class="form-control" id="user-password" name="password"
                                        placeholder="Mật khẩu" value="">
                                    <label for="user-password" class="form-label fw-semibold">Mật khẩu <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="form-outline">
                                    <input type="password" class="form-control" id="user-confirm" name="confirm"
                                        placeholder="Nhập lại mật khẩu" value="">
                                    <label for="user-confirm" class="form-label fw-semibold">Nhập lại mật
                                        khẩu</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6 col-12">
                                <div class="form-outline">
                                    <select class="form-select" id="user-user_catalogue_id" name="user_catalogue_id">
                                        @foreach ($userCatalogues as $userCatalogue)
                                            <option value="{{ $userCatalogue->id }}"
                                                {{ old('user_catalogue_id', 2) == $userCatalogue->id ? 'selected' : '' }}>
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
                                        <option value="0">
                                            Khóa
                                        </option>
                                        <option value="1" selected>
                                            Hoạt động
                                        </option>
                                    </select>
                                    <label for="user-status">Trạng thái</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="user-phone" name="phone"
                                        placeholder="Số điện thoại" value="{{ old('phone') }}">
                                    <label for="user-phone" class="form-label fw-semibold">Số điện thoại <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-12">
                                <div class="form-outline">
                                    <select class="form-select" id="user-gender" name="gender">
                                        <option value="0">
                                            Nữ
                                        </option>
                                        <option value="1">
                                            Nam
                                        </option>
                                    </select>
                                    <label for="user-gender">Giới tính</label>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="form-outline">
                                    <input type="date" class="form-control" id="user-birthday" name="birthday"
                                        placeholder="Ngày sinh" value="{{ old('birthday') }}">
                                    <label for="user-birthday" class="form-label fw-semibold">
                                        Ngày sinh
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <select class="form-select use-select2" id="user-warehouse_id"
                                        name="warehouse_id">
                                        <option value="0">Chọn kho lúa</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}"
                                                {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                                {{ $warehouse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="user-warehouse_id">Kho <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="user-address" name="address"
                                        placeholder="Địa chỉ" value="{{ old('address') }}">
                                    <label for="user-address" class="form-label fw-semibold">Địa chỉ <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>{{-- End: Create and store form --}}

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Thêm người dùng</button>
                </div>
            </form>
        </div>
    </div>
</section>
