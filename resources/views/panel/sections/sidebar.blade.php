<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('console.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('/panel/img/logo/icon2.png') }}" width="25px">
            </span>
            {{-- <span class="app-brand-text demo menu-text fw-bold ms-2">وبلاگ</span> --}}
            <img class="app-brand-text demo menu-text fw-bold ms-2" src="{{ asset('/panel/img/logo/logo.png') }}"
                width="100x">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-item ">
            <a href="{{ route('console.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>صفحه نخست</div>
            </a>
        </li>
        <!-- panels -->


        <li class="menu-item ">
            <a href="{{ route('link.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-link "></i>
                <div>لینک ها</div>
            </a>
        </li>
        {{-- <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-link "></i>
                <div>لینک ها</div>
            </a>
        </li> --}}

        <li class="menu-item">
            <a href="page-2.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Page 2">کاربران</div>
            </a>
        </li>



        <!-- panels -->
        {{-- Add active open class in master menu after menu-item class - add active class to sub menu --}}
        <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="panels">تنظیمات</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item ">
                    <a href="#" class="menu-link">
                        <div data-i18n="Analytics"> سطوح دسترسی</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="eCommerce">تنظیمات عمومی</div>
                    </a>
                </li>




            </ul>
        </li>

    </ul>


</aside>
