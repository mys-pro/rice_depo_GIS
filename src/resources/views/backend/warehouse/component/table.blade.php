<!-- Default Table -->
<table class="table table-responsive">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th class="text-center" scope="col" width="200px">Hình ảnh</th>
            <th scope="col">Tên kho</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col" width="120px">Trạng thái</th>
            <th class="text-end" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($warehouses as $index => $warehouse)
            <tr>
                <th data-title="#" class="table-index align-middle tw-50" scope="row">
                    {{ $warehouses->firstItem() + $index }}
                </th>
                <td class="table-image text-center">
                    <img class="rounded-3"
                        src="{{ isset($warehouse->image) ? $warehouse->image : 'backend/img/default_image.png' }}"
                        alt="" width="114px" height="64px">
                </td>
                <td data-title="Tên kho" class="align-middle">{{ $warehouse->name }}</td>
                <td data-title="Địa chỉ" class="align-middle">{{ $warehouse->address }}</td>
                <td data-title="Trạng thái" class="align-middle">
                    <span
                        class="badge rounded-2 bg-opacity-10 {{ $warehouse->status == 1 ? 'bg-success text-success' : 'bg-warning text-warning' }}">
                        {{ $warehouse->status == 1 ? 'Hoạt động' : 'Ngương hoạt động' }}
                    </span>
                </td>
                <td class="table-action text-end align-middle tw-50">
                    <div class="dropdown">
                        <button class="border-0 bg-transparent" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('warehouse.edit', $warehouse->id) }}">
                                    <i class="bi bi-pencil"></i>
                                    Chỉnh sửa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger"
                                    href="{{ route('warehouse.delete', $warehouse->id) }}"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                    <i class="bi bi-trash3"></i>
                                    Xóa
                                </a>
                            </li>

                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- End Default Table Example -->
{{ $warehouses->links('pagination::bootstrap-5') }}
