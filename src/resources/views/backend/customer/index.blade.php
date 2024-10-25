@include('backend.customer.component.breadcrumb')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách khách hàng</h5>
                    @include('backend.customer.component.filter')
                    <div class="card-content">
                        @include('backend.customer.component.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
