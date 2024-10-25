@include('backend.user.component.breadcrumb')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách nhân viên</h5>
                    @include('backend.user.component.filter')
                    <div class="card-content">
                        @include('backend.user.component.content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
