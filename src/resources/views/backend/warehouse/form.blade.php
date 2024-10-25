@include('backend.warehouse.component.breadcrumb')
<section class="section form-section">
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
            <form method="POST" action="{{ $form }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 mb-3 flex-wrap-reverse">
                    <div class="col-lg-6">
                        <div id="map" class="rounded-3 map-form mapbox"></div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="alert alert-danger mb-3 d-none">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="drop-image">
                                    <div class="image-view {{ isset($warehouse->image) ? 'has-image' : '' }}"
                                        style="background-image: url({{ $warehouse->image ?? '' }}">
                                        <label for="warehouse-image" class="drop-title">
                                            <i class="drop-icon bi bi-cloud-arrow-up-fill text-primary"></i>
                                            <span class="drop-text">Kéo và thả ảnh vào đây</span>
                                            <span class="drop-text text-secondary">Hoặc nhấp để chọn ảnh</span>
                                        </label>
                                        <input type="file" class="input-image d-none" id="warehouse-image"
                                            name="image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="warehouse-name" name="name"
                                        placeholder="Tên kho" value="{{ $warehouse->name ?? old('name') }}">
                                    <label for="warehouse-name" class="form-label fw-semibold">Tên kho <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <select class="form-select" id="warehouse-status" name="status">
                                        <option value="0"
                                            {{ old('status') == 0 || (isset($warehouse) && $warehouse->status == 0) ? 'selected' : '' }}>
                                            Ngưng hoạt động</option>
                                        <option value="1"
                                            {{ old('status') == 1 || empty($warehouse) || (isset($warehouse) && $warehouse->status == 1) ? 'selected' : '' }}>
                                            Hoạt động</option>
                                    </select>
                                    <label for="warehouse-status">Trạng thái</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="warehouse-address" name="address"
                                        placeholder="Địa chỉ" value="{{ $warehouse->address ?? old('address') }}">
                                    <label for="warehouse-address" class="form-label fw-semibold">Địa chỉ <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="form-outline">
                                    <input type="number" class="form-control" id="warehouse-longitude" name="longitude"
                                        step="any" autocomplete="off" placeholder="Kinh độ"
                                        value="{{ $warehouse->longitude ?? old('longitude') }}">
                                    <label for="warehouse-longitude" class="form-label fw-semibold">Kinh độ <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-outline">
                                    <input type="number" class="form-control" id="warehouse-latitude" name="latitude"
                                        step="any" autocomplete="off" placeholder="Vĩ độ"
                                        value="{{ $warehouse->latitude ?? old('latitude') }}">
                                    <label for="warehouse-latitude" class="form-label fw-semibold">Vĩ độ <span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">{{ $action }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
