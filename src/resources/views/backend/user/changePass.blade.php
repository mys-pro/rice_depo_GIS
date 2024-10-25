@include('backend.user.component.breadcrumb')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            @include('backend.user.component.avatar')
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    @include('backend.user.component.tab')
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade pt-3 active show">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Profile Edit Form -->
                            <form method="POST" action="{{ route('user.updatePass', $user->id) }}">
                                @csrf
                                @if ($self)
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-outline">
                                                <input type="password" class="form-control" id="user-old_password"
                                                    name="old_password" placeholder="Mật khẩu" value="">
                                                <label for="user-old_password" class="form-label fw-semibold">Mật khẩu
                                                    cũ<span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row g-3 mb-3">
                                    <div class="col-sm-6 col-12">
                                        <div class="form-outline">
                                            <input type="password" class="form-control" id="user-password"
                                                name="password" placeholder="Mật khẩu" value="">
                                            <label for="user-password" class="form-label fw-semibold">Mật khẩu <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-outline">
                                            <input type="password" class="form-control" id="user-confirm" name="confirm"
                                                placeholder="Nhập lại mật khẩu" value="">
                                            <label for="user-confirm" class="form-label fw-semibold">Nhập lại mật
                                                khẩu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>
                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>
