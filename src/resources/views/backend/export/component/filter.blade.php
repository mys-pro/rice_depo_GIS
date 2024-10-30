<div class="d-flex mb-3">
    <div class="d-flex ms-auto mb-3 mb-lg-0">
        <div class="input-group w-auto me-3">
            <span class="input-group-text bg-transparent border-end-0">
                <i class="bi bi-search"></i>
            </span>
            <input id="search" type="search" class="form-control border-start-0 shadow-none" placeholder="Tìm kiếm..."
                data-url="{{ route('export.index') }}">
        </div>

        <a href="{{ route('export.create') }}" role="button" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
</div>
