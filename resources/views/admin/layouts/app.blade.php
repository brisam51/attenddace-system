<!doctype html>
<html class="no-js" lang="">

@include('admin.layouts.heade')

<body class="rtl persianumber">

    <div class="bmd-layout-container bmd-drawer-f-l avam-container animated bmd-drawer-in">
        @include('admin.layouts.topbar')
        <div id="dw-s1" class="bmd-layout-drawer bg-faded ">

            @include('admin.layouts.sidebar')
        </div>
        <main class="bmd-layout-content">
            <div class="container-fluid ">

                <!-- content -->
                <!-- breadcrumb -->

                <div class="pb-4 m-1 mb-3 row ">
                    <div class="p-2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="page-header breadcrumb-header ">
                            <div class="row align-items-end ">
                                <div class="col-lg-8">
                                    <div class="page-header-title text-left-rtl">
                                        <div class="d-inline">
                                            <h3 class="lite-text ">@yield('dashboard')</h3>
                                            <span class="lite-text "></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item "><a href="#"><i class="fas fa-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item active">داشبورد</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- start main content  --}}
                <div>
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                      </div>

                </div>
                {{-- end main ocntent  --}}

            </div>
        </main>
    </div>

    </div>
   @include('admin.layouts.scripts') 
   

</body>

</html>
