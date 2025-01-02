<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="{{route('admin')}}" class="brand-link">
            <img src="{{asset('user/images/favicon.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">{{session('user_name')}}</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->
    
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="product" data-accordion="false">
                <li class="nav-item">
                     <li class="nav-item">
                        <a href="{{route('admin')}}" class="nav-link">
                            <i class="fa-solid fa-house"></i>
                            <p>Trang Chủ</p>
                        </a>
                    </li>
                </li>
            </ul>

            <!-- Danh Mục -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#menu" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="menuItems">
                        <i class="fa-solid fa-bars"></i>
                        <p>Danh Mục</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview collapse" id="menuItems">
                        <li class="nav-item">
                            <a href="{{route('menu.add')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm Danh Mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('menu.list')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Danh Mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sản Phẩm -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="product" data-accordion="false">
                <li class="nav-item">
                    <a href="#product" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="productItems">
                        <i class="fa-solid fa-shop"></i>
                        <p>Sản Phẩm</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview collapse" id="productItems">
                        <li class="nav-item">
                            <a href="{{route('product.add')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm Sản Phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('product.list')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Sản Phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Slider -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="slider" data-accordion="false">
                <li class="nav-item">
                    <a href="#slider" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sliderItems">
                        <i class="fa-regular fa-images"></i>
                        <p>Slider</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview collapse" id="sliderItems">
                        <li class="nav-item">
                            <a href="{{route('slider.add')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('slider.list')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Slider</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Voucher -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="voucher" data-accordion="false">
                <li class="nav-item">
                    <a href="#voucher" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="voucherItems">
                        <i class="fa-solid fa-ticket"></i>
                        <p>Voucher</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview collapse" id="voucherItems">
                        <li class="nav-item">
                            <a href="{{route('voucher.add')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Thêm Voucher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('voucher.list')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Voucher</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Đơn Hàng -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="order" data-accordion="false">
                <li class="nav-item">
                    <a href="#order" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="orderItems">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <p>Đơn Hàng</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview collapse" id="orderItems">
                        <li class="nav-item">
                            <a href="{{route('order.list')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Danh Sách Đơn Hàng</p>
                            </a>
                            <a href="{{route('Adminorder.cancel')}}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Đơn Hàng Hủy</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Contact -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="product" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('contact.admin')}}" class="nav-link">
                        <i class="fa-solid fa-phone"></i>
                        <p>Contact</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Bootstrap JS (required for collapse functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Script to ensure collapses reset on page reload -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all collapse elements
        var collapses = document.querySelectorAll('.collapse');
        
        // Loop through each collapse and make sure it is closed (by default)
        collapses.forEach(function(collapse) {
            var bsCollapse = new bootstrap.Collapse(collapse, { toggle: false });
            bsCollapse.hide();  // Ensure collapses are closed on page load
        });
    });
</script>
