<!DOCTYPE html>
<html lang="en">
@include('admin.header')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::Search Form-->
                <!--begin::Search Form-->
                <div class="d-flex justify-content-center w-100">
                    <form class="input-group search-bar align-items-center" role="search" action="{{ route('product.search') }}" method="GET">
                        <input
                            class="form-control rounded-start"
                            type="search"
                            placeholder="Search"
                            name="query"
                            aria-label="Search">
                        <button class="btn btn-primary rounded-end" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
                <!--end::Search Form-->

                <!--end::Search Form-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Logout-->
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning text-white rounded" style="border-radius: 10px;">
                                <i class="bi bi-box-arrow-right"></i>
                            </button>

                        </form>
                    </li>
                    <!--end::Logout-->

                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>

        @include('admin.sidebar')
        <main class="app-main m-1">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row m-1">
                        <div class="col-sm-6">
                            <h3 class="mb-0">{{$title}}</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin')}}">Trang Chủ</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$title}}
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->

                    @yield('content')

                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->

        @include('admin.footer')
    </div>
    <!--end::App Wrapper-->
</body>
<!--end::Body-->

</html>