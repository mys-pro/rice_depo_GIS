<!-- Default Table -->
<table class="table table-responsive">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Giới tính</th>
            <th scope="col">SĐT</th>
            <th scope="col">Email</th>
            <th class="text-end" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $index => $customer)
            <tr>
                <th data-title="#" class="table-index" scope="row">
                    {{ $customers->firstItem() + $index }}
                </th>
                <td data-title="Họ tên">
                    {{ $customer->name }}
                </td>
                <td data-title="Giới tính">
                    {{ $customer->gender == 0 ? 'Nữ' : 'Nam' }}
                </td>
                <td data-title="SĐT">
                    {{ $customer->phone }}
                </td>
                <td data-title="Email">
                    {{ $customer->email }}
                </td>
                <td class="table-action text-end align-middle">
                    <div class="dropdown">
                        <button class="border-0 bg-transparent" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.edit', $customer->id) }}">
                                    <i class="bi bi-pencil"></i>
                                    Chỉnh sửa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger"
                                    href="{{ route('customer.delete', $customer->id) }}"
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
{{ $customers->links('pagination::bootstrap-5') }}
