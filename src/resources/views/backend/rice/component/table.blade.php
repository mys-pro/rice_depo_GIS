<!-- Default Table -->
<table class="table table-responsive">
    <thead>
        <tr>
            <th scope="col">Mã số</th>
            <th scope="col">Tên lúa</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col" class="text-end"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rice as $val)
            <tr>
                <th data-title="Mã số" class="table-code">{{ $val->id }}</th>
                <td data-title="Tên lúa">{{ $val->name }}</td>
                <td data-title="Ngày tạo">{{ $val->created_at }}</td>
                <td class="table-action text-end ">
                    <div class="dropdown">
                        <button class="border-0 bg-transparent" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('rice.edit', $val->id) }}">
                                    <i class="bi bi-pencil"></i>
                                    Chỉnh sửa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger"
                                    href="{{ route('rice.delete', $val->id) }}"
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
