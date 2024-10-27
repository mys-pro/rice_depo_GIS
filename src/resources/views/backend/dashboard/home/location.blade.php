{{-- Begin: Location --}}
<div class="offcanvas-body mt-5 px-0">
    {{-- Begin: Location list --}}
    <ul id="warehouse-list" class="list-group list-group-flush user-select-none">
        @if (isset($warehouses))
            @foreach ($warehouses as $warehouse)
                <li class="list-group-item dropdown"
                    data-coordinates="{{ $warehouse->longitude . ',' . $warehouse->latitude }}"
                    data-id="{{ $warehouse->id }}">
                    <div class="row g-3">
                        <div class="col-9 warehouse-list-content">
                            <div class="warehouse-list-name mb-1 fw-bold text-truncate">{{ $warehouse->name }}
                            </div>
                            <div class="warehouse-list-description text-secondary">Nhà kho</div>
                            <div class="warehouse-list-description text-secondary text-truncate">
                                {{ $warehouse->address }}</div>
                            <div
                                class="warehouse-list-description {{ $warehouse->status == '1' ? 'text-success' : 'text-warning' }}">
                                {{ $warehouse->status == '1' ? 'Hoạt động' : 'Ngưng hoạt động' }}</div>
                        </div>

                        <div class="col-3 d-flex align-items-center">
                            <img class="rounded-3"
                                src="{{ asset(isset($warehouse->image) ? $warehouse->image : 'backend/img/default_image.png') }}"
                                alt="" width="80px" height="80px">
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul> {{-- End: Location list --}}
</div>
{{-- End: Location --}}