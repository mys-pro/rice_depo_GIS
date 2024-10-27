@include('backend.import.component.breadcrumb')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách nhập kho</h5>
                    @include('backend.import.component.filter')
                    <div class="card-content">
                        @include('backend.import.component.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
