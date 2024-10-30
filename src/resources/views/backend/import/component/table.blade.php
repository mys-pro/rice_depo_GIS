<table class="table table-responsive">
    <thead>
        <tr>
            <th scope="col" class="align-middle">Mã số</th>
            <th scope="col" class="align-middle">Kho</th>
            <th scope="col" class="align-middle">Nhân viên</th>
            <th scope="col" class="align-middle">Khách hàng</th>
            <th scope="col" class="align-middle">Ngày tạo</th>
            <th scope="col" class="align-middle text-end"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($imports as $import)
            <tr>
                <th data-title="Mã số" class="table-code tw-50 align-middle">{{ $import->id }}</th>
                <td data-title="Kho" class="align-middle">{{ $import->warehouse_name }}</td>
                <td data-title="Nhân viên" class="align-middle">{{ $import->user_name }}</td>
                <td data-title="Khách hàng" class="algin-middle">{{ $import->customer_name }}</td>
                <td data-title="Ngày tạo" class="algin-midlle text-nowrap">{{ $import->created_at->format('d-m-Y') }}
                </td>
                <td class="table-action text-end tw-50">
                    <div class="dropdown">
                        <button class="border-0 bg-transparent" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('import.edit', $import->id) }}">
                                    <i class="bi bi-pencil"></i>
                                    Chỉnh sửa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('import.delete', $import->id) }}"
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
{{ $imports->links('pagination::bootstrap-5') }}
