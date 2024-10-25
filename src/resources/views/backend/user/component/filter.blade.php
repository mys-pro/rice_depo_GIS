<div class="d-flex mb-3">
    <div class="dropdown me-3 z-1">
        <button class="btn btn-secondary dropdown-toggle filter" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" data-bs-auto-close="false">
            <i class="bi bi-funnel-fill"></i>
        </button>
        <div class="dropdown-menu filter-menu p-0">
            <div class="border-bottom p-3">
                <span class="fw-bold">Bộ lọc</span>
            </div>

            <div class="p-3">
                <div class="mb-3">
                    <label for="user-filter-status" class="form-label">Trạng thái</label>
                    <select id="user-filter-status" class="form-select shadow-none filter-item" data-name="status">
                        <option value="" selected>Tất cả</option>
                        <option value="0">Khóa</option>
                        <option value="1">Hoạt động</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user-filter-user_catalogue_id" class="form-label">Người dùng</label>
                    <select id="user-filter-user_catalogue_id" class="form-select shadow-none filter-item" data-name="user_catalogue">
                        <option value="" selected>Tất cả</option>
                        @foreach ($userCatalogues as $userCatalogue)
                            <option value="{{ $userCatalogue->id }}">{{ $userCatalogue->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user-filter-warehouse" class="form-label">Kho lúa</label>
                    <select id="user-filter-warehouse" class="form-select shadow-none use-select2 filter-item" data-name="warehouse">
                        <option value="" selected>Tất cả</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex ms-auto mb-3 mb-lg-0">
        <div class="input-group w-auto me-3">
            <span class="input-group-text bg-transparent border-end-0">
                <i class="bi bi-search"></i>
            </span>
            <input id="search" type="search" class="form-control border-start-0 shadow-none"
                placeholder="Tìm kiếm..." data-url="{{ route('user.index') }}">
        </div>

        <a href="{{ route('user.create') }}" role="button" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
</div>
