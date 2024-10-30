<table class="table table-responsive">
    <thead>
        <tr>
            <th scope="col">Mã số</th>
            <th scope="col">Kho</th>
            <th scope="col">Nhân viên</th>
            <th scope="col">Khách hàng</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col" class="text-end"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($exports as $export)
            <tr>
                <th data-title="Mã số" class="table-code tw-50">{{ $export->id }}</th>
                <td data-title="Kho">{{ $export->warehouse_name }}</td>
                <td data-title="Nhân viên">{{ $export->user_name }}</td>
                <td data-title="Khách hàng">{{ $export->customer_name }}</td>
                <td data-title="Ngày tạo">{{ $export->created_at->format('d-m-Y') }}</td>
                <td class="table-action text-end tw-50">
                    <div class="dropdown">
                        <button class="border-0 bg-transparent" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('export.edit', $export->id) }}">
                                    <i class="bi bi-pencil"></i>
                                    Chỉnh sửa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('export.delete', $export->id) }}"
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
{{ $exports->links('pagination::bootstrap-5') }}