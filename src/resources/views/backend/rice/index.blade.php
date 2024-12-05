@include('backend.rice.component.breadcrumb')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách lúa</h5>
                    @include('backend.rice.component.filter')
                    <div class="card-content">
                        @include('backend.rice.component.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>