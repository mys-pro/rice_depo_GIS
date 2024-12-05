@include('backend.rice.component.breadcrumb')
<section class="section">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="import-form" method="POST" action="{{ $form }}">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin chung</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-12">
                                <div class="form-outline">
                                    <select class="form-select use-select2" id="import-warehouse" name="warehouse_id">
                                        <option value="0">Chọn kho lúa</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}"
                                                {{ old('warehouse_id') == $warehouse->id || (isset($import) && $import->warehouse_id == $warehouse->id) ? 'selected' : '' }}>
                                                {{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="import-warehouse">
                                        Kho lúa
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="form-outline">
                                    <select class="form-select use-select2" id="import-customer" name="customer_id">
                                        <option value="0">Chọn khách hàng</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer_id') == $customer->id || (isset($import) && $import->customer_id == $customer->id) ? 'selected' : '' }}>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="import-customer">
                                        Khách hàng
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <div class="form-outline">
                                    <textarea type="text" class="form-control" id="import-note" name="note" placeholder="Ghi chú"
                                        style="height: 100px">{{ $import->note ?? old('note') }}</textarea>
                                    <label for="import-note" class="form-label fw-semibold">Ghi chú</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh sách nhập</h5>

                        <div class="row g-3">
                            <div class="col-12">
                                <table class="table table-borderless table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" width="50%">Lúa</th>
                                            <th class="text-center" scope="col" width="20%">Khối lượng (kg)</th>
                                            <th class="text-center" scope="col" width="30%">Đơn giá</th>
                                            <th scope="col" width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (old('inputs'))
                                            @foreach (old('inputs') as $index => $val)
                                                <tr>
                                                    <th data-title="#" class="table-index align-middle tw-50"
                                                        scope="row">{{ $index + 1 }}
                                                    </th>
                                                    <td data-title="Lúa" class="align-middle">
                                                        <select class="form-select use-select2"
                                                            name="inputs[{{ $index }}][rice_id]">
                                                            <option value="0">Chọn lúa</option>
                                                            @foreach ($rice as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $val['rice_id'] == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td data-title="Khối lượng (kg)" class="align-middle tw-50">
                                                        <div class="input-weight">
                                                            <button class="btn btn-primary input-dash">
                                                                <i class="bi bi-dash"></i>
                                                            </button>
                                                            <input type="number"
                                                                class="form-control border-0 shadow-none hide-spin"
                                                                name="inputs[{{ $index }}][weight]"
                                                                value="{{ $val['weight'] }}">
                                                            <button class="btn btn-primary input-plus">
                                                                <i class="bi bi-plus"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td data-title="Đơn giá" class="align-middle tw-50">
                                                        <div class="input-group">
                                                            <input name="inputs[{{ $index }}][price]"
                                                                type="text"
                                                                class="form-control input-format input-price border-end-0 pe-0"
                                                                value="{{ $val['price'] }}">
                                                            <span
                                                                class="input-group-text bg-transparent border-start-0">₫</span>
                                                        </div>
                                                    </td>
                                                    <td class="table-action text-end align-middle tw-50">
                                                        <button class="import_detail-delete border-0 bg-transparent">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @elseif(isset($import))
                                            @foreach ($import->import_detail as $index => $val)
                                                <tr>
                                                    <th data-title="#" class="table-index align-middle tw-50"
                                                        scope="row">{{ $index + 1 }}
                                                    </th>
                                                    <td data-title="Lúa" class="align-middle">
                                                        <select class="form-select use-select2"
                                                            name="inputs[{{ $index }}][rice_id]">
                                                            <option value="0">Chọn lúa</option>
                                                            @foreach ($rice as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $val['rice_id'] == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td data-title="Khối lượng (kg)" class="align-middle tw-50">
                                                        <div class="input-weight">
                                                            <button class="btn btn-primary input-dash">
                                                                <i class="bi bi-dash"></i>
                                                            </button>
                                                            <input type="number"
                                                                class="form-control border-0 shadow-none hide-spin"
                                                                name="inputs[{{ $index }}][weight]"
                                                                value="{{ $val['weight'] }}">
                                                            <button class="btn btn-primary input-plus">
                                                                <i class="bi bi-plus"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td data-title="Đơn giá" class="align-middle tw-50">
                                                        <div class="input-group">
                                                            <input name="inputs[{{ $index }}][price]"
                                                                type="text"
                                                                class="form-control input-format input-price border-end-0 pe-0"
                                                                value="{{ number_format($val['price'], 0, '', '.') }}">
                                                            <span
                                                                class="input-group-text bg-transparent border-start-0">₫</span>
                                                        </div>
                                                    </td>
                                                    <td class="table-action text-end align-middle tw-50">
                                                        <button class="import_detail-delete border-0 bg-transparent">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th data-title="#" class="table-index align-middle tw-50"
                                                    scope="row">1
                                                </th>
                                                <td data-title="Lúa" class="align-middle">
                                                    <select class="form-select use-select2" name="inputs[0][rice_id]">
                                                        <option value="0">Chọn lúa</option>
                                                        @foreach ($rice as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('inputs.0.rice_id') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td data-title="Khối lượng (kg)" class="align-middle tw-50">
                                                    <div class="input-weight">
                                                        <button class="btn btn-primary input-dash">
                                                            <i class="bi bi-dash"></i>
                                                        </button>
                                                        <input type="number"
                                                            class="form-control border-0 shadow-none hide-spin"
                                                            name="inputs[0][weight]"
                                                            value="{{ old('inputs.0.weight') ?? 1 }}">
                                                        <button class="btn btn-primary input-plus">
                                                            <i class="bi bi-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td data-title="Đơn giá" class="align-middle tw-50">
                                                    <div class="input-group">
                                                        <input name="inputs[0][price]" type="text"
                                                            class="form-control input-format input-price border-end-0 pe-0"
                                                            value="{{ old('inputs.0.price') ?? 0 }}">
                                                        <span
                                                            class="input-group-text bg-transparent border-start-0">₫</span>
                                                    </div>
                                                </td>
                                                <td class="table-action text-end align-middle tw-50">
                                                    <button class="import_detail-delete border-0 bg-transparent">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <button id="import_detail-add-btn" class="btn btn-secondary">
                            Thêm hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="total-price">
                                <span class="price-label">Tổng tiền:</span>
                                <span class="price">{{ $total ?? '0' }}</span>
                                <span class="price-unit">₫</span>
                            </div>
                            <button id="import-submit" class="btn btn-primary">{{ $action }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<script>
    @if (isset($import))
        let inputIndex = {{ count($import->import_detail) - 1 }};
    @else
        let inputIndex = {{ old('inputs') ? count(old('inputs', [])) - 1 : 0 }};
    @endif

    const rice_data = [
        @foreach ($rice as $val)
            {
                id: {{ $val->id }},
                name: '{{ $val->name }}',
            },
        @endforeach
    ];
</script>
