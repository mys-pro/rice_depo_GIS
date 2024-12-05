@include('backend.warehouse.component.breadcrumb')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách kho lúa</h5>
                    @include('backend.warehouse.component.filter')
                    <div class="card-content">
                        @include('backend.warehouse.component.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section
