<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Nozha admin panel</title>
	<meta name="description" content="nozha admin panel fully support rtl with complete dark mode css to use. ">
	<meta name=”robots” content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="180x180" href="{{url('dashboard/img/favicon/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{url('dashboard/img/favicon/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href=".{{url('dashboard/img/favicon/favicon-16x16.png')}}">
	<link rel="manifest" href="{{url('dashboard/img/favicon/site.webmanifest')}}">
	<link rel="mask-icon" href="{{url('dashboard/img/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="theme-color" content="#ffffff">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="{{url('dashboard/css/normalize.css')}}">
    <link href="{{url('dashboard/css/fontawsome/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{url('dashboard/css/main.css')}}">
</head>

<body class="rtl persianumber">

    <div class="bmd-layout-container bmd-drawer-f-l avam-container animated bmd-drawer-in">
        <header class="bmd-layout-header ">
            <div class="navbar navbar-light bg-faded animate__animated animate__fadeInDown">
                <button class="navbar-toggler animate__animated animate__wobble animate__delay-2s" type="button"
                    data-toggle="drawer" data-target="#dw-s1">
                    <span class="navbar-toggler-icon"></span>
                    <!-- <i class="material-Animation">menu</i> -->
                </button>
                <ul class="nav navbar-nav p-0">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn  dropdown-toggle  m-0" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-envelope fa-lg"></i><span
                                    class="badge badge-pill badge-danger animate__animated animate__flash animate__repeat-3 animate__slower animate__delay-2s">5</span>
                            </button>
                            <div aria-labelledby="dropdownMenu2"
                                class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-menu-right-lg">
                                <span class="dropdown-item dropdown-header">15 اطلاعیه</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="far fa-envelope c-main mr-2"></i> 4 پیام جدید
                                    <span class="float-right-rtl text-muted text-sm">3 دقیقه پیش</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="far fa-user c-main mr-2"></i> 8 درخواست دوستی
                                    <span class="float-right-rtl text-muted text-sm">12 ساعت پیش</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="far fa-file c-main mr-2"></i> 3 گزارش جدید
                                    <span class="float-right-rtl text-muted text-sm">2 روز پیش</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">دیدن همه</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn  dropdown-toggle m-0" type="button" id="dropdownMenu3"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-bell  fa-lg "></i><span
                                    class="badge badge-pill badge-warning animate__animated animate__flash animate__repeat-3 animate__slower animate__delay-2s">5</span>
                            </button>
                            <div aria-labelledby="dropdownMenu2"
                                class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-menu-right-lg">
                                <span class="dropdown-item dropdown-header persianumber">15 اطلاعیه</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="far fa-envelope c-main mr-2"></i> 4 پیام جدید
                                    <span class="float-right-rtl text-muted text-sm">3 دقیقه پیش</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="far fa-user c-main mr-2"></i> 8 درخواست دوستی
                                    <span class="float-right-rtl text-muted text-sm">12 ساعت پیش</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="far fa-file c-main mr-2"></i> 3 گزارش جدید
                                    <span class="float-right-rtl text-muted text-sm">2 روز پیش</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">دیدن همه</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"> <img src="./img/user-profile.jpg" alt="..."
                            class="rounded-circle screen-user-profile"></li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn  dropdown-toggle m-0" type="button" id="dropdownMenu4"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                مجید
                            </button>
                            <div aria-labelledby="dropdownMenu4"
                                class="dropdown-menu  pl-3 dropdown-menu-right dropdown-menu dropdown-menu-right"
                                aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button"><i
                                        class="far fa-user c-main fa-sm mr-2"></i>پروفایل</button>
                                <button onclick="dark()" class="dropdown-item" type="button"><i
                                        class="fas fa-moon fa-sm c-main mr-2"></i>حالت شب</button>
                                <button class="dropdown-item" type="button"><i
                                        class="fas fa-cog c-main fa-sm mr-2"></i>تنظیمات</button>
                                <button class="dropdown-item" type="button"><i
                                        class="fas fa-sign-out-alt c-main fa-sm mr-2"></i>خروج</button>
                            </div>
                        </div>
                    </li>




                </ul>
            </div>
        </header>
        <div id="dw-s1" class="bmd-layout-drawer bg-faded ">

            <div class="container-fluid side-bar-container ">
                <header class="pb-0">
                    <a class="navbar-brand ">
                        <object class="side-logo" data="./svg/logo-8.svg" type="image/svg+xml">
                        </object>
                    </a>
                </header>
                <p class="side-comment  fnt-mxs">گشت</p>
                <li class="side a-collapse short m-2 pr-1 pl-1">
                    <a href="./fa.html" class="side-item selected c-dark "><i class="fas fa-language  mr-1"></i>فارسی <span
                            class="badge badge-pill badge-success">جدید</span></a>
                </li>
                <ul class="side a-collapse short ">
                    <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> صفحه
                        <!-- <span class="badge badge-info">4</span> -->
                        <i class="fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container hide animated">
                        <li class="side-item "><a href="./" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>پنل کاربری</a>
                        </li>
                        <li class="side-item"><a href="./dark.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>پنل کاربری تاریک</a>
                        </li>
                        <li class="side-item"><a href="./Login.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>صفحه ورود</a></li>
						<li class="side-item"><a href="./glogin.html"><i class="fas fa-angle-right mr-2"></i>صفحه ورود رنگی</a></li>

                    </div>
                </ul>

                <ul class="side a-collapse short">
                    <a class="ul-text  fnt-mxs"><i class="fas fa-cog mr-1"></i> شخصی سازی
                        <!-- <span	class="badge badge-success">4</span> -->
                        <i class="fas fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container hide animated">
                        <li class="side-item"><a href="./color.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>رنگ</a></li>
                        <li class="side-item"><a href="./typo.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>تایپوکرافی</a></li>
                        <li class="side-item"><a href="./dark-mode.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>حالت شب</a></li>
                        <li class="side-item"><a href="./rtl.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>راست چین</a></li>
                        <li class="side-item"><a href="./sidebar.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>ساید بار</a></li>
                    </div>
                </ul>
                <p class="side-comment  fnt-mxs">عناصر</p>
                <li class="side a-collapse short ">
                    <a href="./animation.html" class="side-item "><i class="fas fa-fan fa-spin mr-1"></i>انیمشین</a>
                </li>
                <li class="side a-collapse short ">
                    <a href="./Icon.html" class="side-item "><i class="fas fa-icons  mr-1"></i>آیکون</a>
                </li>

                <ul class="side a-collapse short ">
                    <a class="ul-text  fnt-mxs"><i class="fas fa-cube mr-1"></i> کامپوننت های پایه <span
                            class="badge badge-danger">9</span><i class="fas fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container hide animated">
                        <li class="side-item"><a href="./alert.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>alert</a>
                        </li>
                        <li class="side-item"><a href="./badge.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Badge</a></li>
                        <li class="side-item"><a href="./breadcrumb.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Breadcrumb</a></li>
                        <li class="side-item"><a href="./button.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Button</a></li>
                        <li class="side-item"><a href="./card.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Card</a></li>
                        <li class="side-item"><a href="./collapse.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Collapse</a></li>
                        <li class="side-item"><a href="./Input.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Input</a></li>
                        <li class="side-item"><a href="./jumborton.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Jumborton</a></li>
                        <li class="side-item"><a href="./pagination.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Pagination</a></li>
                        <li class="side-item"><a href="./progress.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Progress</a></li>
                    </div>
                </ul>
                <ul class="side a-collapse short">
                    <a class="ul-text  fnt-mxs"><i class="fas fa-layer-group mr-1"></i>کامپوننت های اضافی
                        <!-- <span class="badge badge-warning">6</span> -->
                        <i class="fas fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container hide animated">
                        <li class="side-item"><a href="./modal.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Modal</a></li>
                        <li class="side-item"><a href="./toast.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Toast</a></li>
                        <li class="side-item"><a href="./widget.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Widget</a></li>
                        <li class="side-item"><a href="./Chart.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Chart</a></li>

                    </div>
                </ul>

                <p class="side-comment  fnt-mxs">پشتیبانی</p>
                <li class="side a-collapse short ">
                    <a href="https://github.com/MajidAlinejad/Nozha-rtl-Dashboard" class="side-item  fnt-mxs "><i class=" fab fa-github mr-1"></i>GitHub</a>
                </li>
                <li class="side a-collapse short ">
                    <a href="https://github.com/MajidAlinejad/Nozha-rtl-Dashboard" class="side-item  fnt-mxs "><i class=" far fa-question-circle mr-1"></i>گزارش باگ</a>
                </li>
                <li class="side a-collapse short ">
                    <a href="https://github.com/MajidAlinejad/Nozha-rtl-Dashboard" class="side-item  fnt-mxs "><i class=" far fa-life-ring mr-1"></i>حل مشکل</a>
                </li>

                <p class="side-comment  fnt-mxs">اهدا</p>
                <li class="side a-collapse short pb-5">
                    <a href="https://donateon.ir/alinejad.mj" class="side-item  fnt-mxs "><i class=" fas fa-coffee mr-1"></i>کمک به توسعه دهنده </a>
                </li>


            </div>

        </div>
        <main class="bmd-layout-content">
            <div class="container-fluid ">

                <!-- content -->
                <!-- breadcrumb -->

                <div class="row  m-1 pb-4 mb-3 ">
                    <div class="col-xs-12  col-sm-12  col-md-12  col-lg-12 p-2">
                        <div class="page-header breadcrumb-header ">
                            <div class="row align-items-end ">
                                <div class="col-lg-8">
                                    <div class="page-header-title text-left-rtl">
                                        <div class="d-inline">
                                            <h3 class="lite-text ">داشبورد</h3>
                                            <span class="lite-text ">گزارش ها و آمار</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item "><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item active">داشبورد</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- alert -->
                <!-- <div class="row m-1 pb-3 ">

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-2">
						<div class="alert alert-danger alert-shade alert-dismissible fade show" role="alert">
							<strong>Danger!</strong> Your Disk is Low.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
					</div>

				</div> -->
                <!-- widget -->
                <div class="row m-1 mb-2">
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY   "><i
                                class="fab far fa-chart-bar b-first" aria-hidden="true"></i>
                            <span class="mb-1 c-first">امتیاز</span>
                            <span>30%</span>
                            <p class="mt-3 mb-1 text-right"><i class="far fas fa-wallet mr-1 c-first"></i> در حال
                                پیشرفت</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY    "><i
                                class="fab far fa-clock b-second" aria-hidden="true"></i>
                            <span class="mb-1 c-second">بازدید</span>
                            <span>27</span>
                            <p class="mt-3 mb-1 text-right"><i class="far fas fa-wifi mr-1 c-second"></i>در حال پیشرفت
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY   "><i
                                class="fab far fa-comments b-third" aria-hidden="true"></i>
                            <span class="mb-1 c-third">پیام ها</span>
                            <span>5</span>
                            <p class="mt-3 mb-1 text-right"><i class="fab fa-whatsapp mr-1 c-third"></i>در حال پیشرفت
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
                        <div class="box-card text-right mini animate__animated animate__flipInY   "><i
                                class="fab far fa-gem b-forth" aria-hidden="true"></i>
                            <span class="mb-1 c-forth">منابع</span>
                            <span>55,223</span>
                            <p class="mt-3 mb-1 text-right"><i class="fab fa-bluetooth mr-1 c-forth"></i>در حال پیشرفت
                            </p>
                        </div>
                    </div>
                </div>


                <div class="row m-2 mb-1">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-2">
                        <div class="alert text-dir-rtl text-right  alert-third alert-shade alert-dismissible fade show"
                            role="alert">
                            <strong>هشدار!</strong> این یک متن هشدار است.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="row m-1">
                    <div class="col-xs-1 col-sm-1 col-md-8 col-lg-8 p-2">
                        <div class="card shade h-100">
                            <div class="card-body">
                                <h5 class="card-title">نمودار بار/خط</h5>

                                <hr>
                                <canvas id="myChart5"></canvas>
                                <hr class="hr-dashed">
                                <p class="text-center c-danger">یک نمونه از نمودار</p>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-1 col-sm-1 col-md-4 col-lg-4 p-2">
                        <div class="card flat f-first h-100">
                            <div class="card-body">
                                <h5 class="card-title">افزونه آب و هوا</h5>

                                <hr>
                                <a class="weatherwidget-io" href="https://forecast7.com/en/37d5545d08/urmia/"
                                    data-label_1="URMIA" data-label_2="WEATHER" data-icons="Climacons Animated"
                                    data-days="5" data-textcolor="#fafafaad"></a>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mb-2 m-2">
                    <div class="col-xl-8 col-md-6 col-sm-6 p-2">
                        <div class="box-dash h-100 pastel animate__animated animate__flipInY b-second   "><i
                                class="fab far fa-clock" aria-hidden="true"></i>

                            <span>27</span>
                            <hr class="m-0 ">
                            <span>بازدید</span>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-6 p-2">
                        <div class="box-card h-100 flat f-main animate__animated animate__flipInY   ">

                            <iframe
                                src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=Asia%2FTehran"
                                width="100%" height="115" frameborder="0" seamless></iframe>
                        </div>
                    </div>



                </div>
                <div class="row m-1">
                    <div class="col-xs-1 col-sm-1 col-md-4 col-lg-4 p-2">
                        <div class="card shade h-100">
                            <div class="card-body">
                                <h5 class="card-title">نمودار دایره ای</h5>

                                <hr>
                                <canvas id="myChart4" width="10" height="11"></canvas>
                                <hr class="hr-dashed">
                                <p class="text-center c-danger">نمونه ای از نمودار</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-8 col-lg-8 p-2">
                        <div class="card shade h-100">
                            <div class="card-body">
                                <h5 class="card-title">اطلاعات در قالب جدول</h5>

                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ردیف</th>
                                            <th scope="col">نام</th>
                                            <th scope="col">نام خانوادگی</th>
                                            <th scope="col">منشن</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>مارک</td>
                                            <td>لنترن</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>جیکوب</td>
                                            <td>رایان</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>لری</td>
                                            <td>اسمیت</td>
                                            <td>@twitter</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>جیکوب</td>
                                            <td>رایان</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>لری</td>
                                            <td>اسمیت</td>
                                            <td>@twitter</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>جیکوب</td>
                                            <td>رایان</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>لری</td>
                                            <td>اسمیت</td>
                                            <td>@twitter</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>


                <div class="row m-1">
                    <div class="col-xs-1 col-sm-1 col-md-8 col-lg-8 p-2">
                        <div class="alert col-12  alert-success alert-shade-white bd-side alert-dismissible fade show"
                            role="alert">
                            <strong>هشدار!</strong>این یک متن هشدار است.

                        </div>
                        <div id="accordion " class="accordion card shade outlined o-forth w-100">
                            <div class="">
                                <div class="card-header mr-3 ml-3 pr-0 pl-0" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link c-grey w-100 m-0 text-right" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            عنوان شماره یک
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از
                                        طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                        لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود
                                        ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده،
                                        شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای
                                        طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد،
                                        در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط
                                        سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی
                                        سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="card-header mr-3 ml-3 pr-0 pl-0" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link c-grey collapsed w-100 m-0 text-right"
                                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            عنوان شماره دو
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از
                                        طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                        لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود
                                        ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده،
                                        شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای
                                        طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد،
                                        در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط
                                        سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی
                                        سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="card-header mr-3 ml-3 pr-0 pl-0" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link c-grey collapsed w-100 m-0 text-right"
                                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            عنوان شماره سه
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از
                                        طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                        لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود
                                        ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده،
                                        شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای
                                        طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد،
                                        در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط
                                        سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی
                                        سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 p-2">
                        <div class="card shade h-100">
                            <div class="card-body">
                                <h5 class="card-title">نمودار قطبی</h5>

                                <hr>
                                <canvas id="myChart2" width="10" height="13"></canvas>

                            </div>

                        </div>
                    </div>

                </div>





            </div>
        </main>
    </div>

    </div>



    <script src="{{url('dashboard/js/vendor/modernizr.js`')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="{{url('dashboard/js/vendor/jquery-3.2.1.min.js')}}"><\/script>')
    </script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{url('dashboard/js/persianumber.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('body').bootstrapMaterialDesign();
            $('.persianumber').persiaNumber();

        });
    </script>
    <script>
        ! function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://weatherwidget.io/js/widget.min.js';
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, 'script', 'weatherwidget-io-js');
    </script>
    <script src="{{url('dashboard/js/main.js')}}"></script>

</body>

</html>
