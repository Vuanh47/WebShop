<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link"> <!--begin::Brand Image--> <img src="{{asset('admin/dist/assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open"> <a href="#" class="nav-link active"><i class="fa-solid fa-bars"></i></i>
                        <p>
                            Danh Mục
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('menu.add') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm Danh Mục</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{route('menu.list')  }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Danh Mục</p>
                            </a> </li>
                        
                    </ul>
                </li>
            
            </ul> <!--end::Sidebar Menu-->

            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="product" data-accordion="false">
                <li class="nav-item menu-open"> <a href="#" class="nav-link active"> <i class="fa-solid fa-shop"></i></i>
                        <p>
                            Sản Phẩm
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('product.add') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm Sản Phẩm</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{route('product.list')  }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách  Sản Phẩm</p>
                            </a> </li>
                        
                    </ul>
                </li>
            
            </ul> <!--end::Sidebar product-->

            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="slider" data-accordion="false">
                <li class="nav-item menu-open"> <a href="#" class="nav-link active"> <i class="fa-regular fa-images"></i></i>
                        <p>
                            Slider
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('slider.add') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm  Slider</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{route('slider.list')  }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Slider</p>
                            </a> </li>
                        
                    </ul>
                </li>
            
            </ul> <!--end::Sidebar Menu-->

            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="voucher" data-accordion="false">
                <li class="nav-item menu-open"> <a href="#" class="nav-link active"><i class="fa-solid fa-ticket"></i></i>
                        <p>
                            Voucher
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('voucher.add') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm  Voucher</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{route('voucher.list')  }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Voucher</p>
                            </a> </li>
                        
                    </ul>
                </li>
            
            </ul> <!--end::Sidebar Voucher-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="order" data-accordion="false">
                <li class="nav-item menu-open"> <a href="#" class="nav-link active"><i class="fa-solid fa-ticket"></i></i>
                        <p>
                            Đơn Hàng
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('order.list') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Đơn Hàng</p>
                            </a> 
                        </li>
                        
                        
                    </ul>
                </li>
            
            </ul> <!--end::Sidebar Voucher-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->

