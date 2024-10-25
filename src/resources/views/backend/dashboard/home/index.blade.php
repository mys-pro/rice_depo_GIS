<main class="main">
    {{-- Begin: Dashboard Search --}}
    <aside class="offcanvas offcanvas-start rounded-3 overflow-hidden border-0 mapboxgl-control-shadow z-3"
        data-bs-backdrop="false" data-bs-scroll="true" tabindex="-1" id="sidebar-start">
    </aside>
    <div class="search-bar bg-white input-group position-fixed z-3 mapboxgl-control-shadow rounded-3 overflow-hidden">
        <button class="btn bg-white border-0 rounded-start" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebar-home">
            <i class="bi bi-list fs-4"></i>
        </button>

        <input id="dashboard-search" type="text" class="form-control shadow-none border-0 p-0 pe-sm-0 pe-5"
            placeholder="Tìm kho lúa..." aria-label="Recipient's username with two button addons">

        <label for="dashboard-search" class="input-group-text bg-white border-0 text-secondary d-none d-sm-flex pe-3">
            <i class="bi bi-search fs-5"></i>
        </label>

        <div class="header-nav dropdown d-block d-sm-none m-0 pe-3">
            @include('backend.dashboard.component.profile')
        </div><!-- End Profile Nav -->

        <div class="py-2 px-1">
            <div class="vr h-100"></div>
        </div>

        <button id="warehouse-list-btn" class="btn bg-white border-0 pe-3" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebar-start">
            <i class="bi bi-bookmark"></i>
        </button>
    </div>{{-- End: Dashboard Search --}}

    <div class="header-nav dropdown position-fixed z-3 end-0 d-none d-sm-block">
        @include('backend.dashboard.component.profile')
    </div><!-- End Profile Nav -->

    <aside class="offcanvas offcanvas-start" tabindex="-1" id="sidebar-home">
        <div class="sibebar-logo border-bottom d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="{{ asset('backend/img/logo.png') }}" alt="">
                <span class="d-block">RiceDepo</span>
            </a>
        </div>

        <ul class="sidebar-nav overflow-y-auto" id="sidebar-nav">
            @include('backend.dashboard.component.menu')
        </ul>
    </aside>

    <section>
        <div id="map" class="mapbox vh-100"></div>
    </section>
</main>

@include('backend.dashboard.component.script')
