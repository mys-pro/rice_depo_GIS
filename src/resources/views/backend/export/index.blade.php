@include('backend.export.component.breadcrumb')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách xuất kho</h5>
                    @include('backend.export.component.filter')
                    <div class="card-content">
                        @include('backend.export.component.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
