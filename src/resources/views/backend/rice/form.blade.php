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
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-outline">
                            <input type="text" class="form-control" id="rice-name" name="name"
                                placeholder="Tên lúa" value="{{ $rice->name ?? old('name') }}">
                            <label for="rice-name" class="form-label fw-semibold">Tên lúa</label>
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
