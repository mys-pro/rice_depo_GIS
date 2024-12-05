@include('backend.rice.component.breadcrumb')
<section class="section form-section">
    <div class="card form-fill">
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ $form }}">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="customer-name" name="name"
                                placeholder="Tên khách hàng" value="{{ $customer->name ?? '' }}">
                            <label for="customer-name" class="form-label fw-semibold">Tên khách hàng <span
                                    class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="customer-email" name="email"
                                placeholder="email" value="{{ $customer->email ?? '' }}">
                            <label for="customer-name" class="form-label fw-semibold">Email <span
                                    class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>


                <div class="row g-3 mb-3">
                    <div class="col-sm-6 col-12">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="customer-phone" name="phone"
                                placeholder="Số điện thoại" value="{{ $customer->phone ?? '' }}">
                            <label for="customer-phone" class="form-label fw-semibold">Số điện thoại <span
                                    class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-12">
                        <div class="form-outline">
                            <select class="form-select" id="customer-gender" name="gender">
                                <option value="0"
                                    {{ isset($customer) && $customer->gender == 0 ? 'selected' : '' }}>Nữ
                                </option>
                                <option value="1"
                                    {{ empty($customer) || (isset($customer) && $customer->gender == 1) ? 'selected' : '' }}>
                                    Nam
                                </option>
                            </select>
                            <label for="customer-gender">Giới tính</label>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">{{ $action }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
