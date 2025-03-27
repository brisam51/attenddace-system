<div class="container-fluid side-bar-container ">
    <header class="pb-0">
        <a class="navbar-brand ">
            <object class="side-logo" data="{{ url('dashboard/svg/logo-8.svg') }}" type="image/svg+xml">
            </object>
        </a>
    </header>
   
    <li class="side a-collapse short ">
        <a href="{{ url('/') }}" class="side-item "><i
                class="fa fa-desktop mr-2" style="font-size: 18px"></i>داشبورد </a>
    </li>

    <li class="side a-collapse short " style="margin-bottom: 10px;">
        <a href="{{ url('user/index') }}" class="side-item @if (Request::segment(1) == 'user' ) bg-primary text-whaite @endif"><i class="fa fa-users mr-2" aria-hidden="true" style="font-size: 20px;"></i>مدیریت کاربران</a>
    </li>
    <li class="side a-collapse short ">
        <a href="{{ url('projects/index') }}" class="side-item @if (Request::segment(1) == 'projects') bg-primary text-white @endif"><i
                class="fa fa-folder-open mr-2" style="font-size: 20px;" aria-hidden="true"></i>مدیریت پروژه ها</a>
    </li>
    <li class="side a-collapse short ">
        <a href="{{ url('tasks/index') }}" class="side-item @if(Request::segment(1) == 'tasks')bg-primary text-white @endif "   ><i class="fa fa-tasks mr-2" style="font-size: 20px;" aria-hidden="true"></i>مدیریت وظایف </a>
              
    </li>
    <li class="side a-collapse short ">
        <a href="{{ url('attendance/index') }}" class="side-item @if(Request::segment(1) == 'attendance')bg-primary text-white @endif "   ><i class="fa fa-clock mr-2" style="font-size: 20px;" aria-hidden="true"></i>  حضور و غیاب اتوماتیک</a>
               </a>
    </li>
    <li class="side a-collapse short ">
        <a href="" class="side-item @if(Request::segment(1) == '')bg-primary text-white @endif "   ><i class="fa fa-pencil-alt mr-2" style="font-size: 20px;" aria-hidden="true"></i> حضور و غیاب دستی</a>
                مدیریت حضور و غیاب دستی </a>
    </li>
    
    <ul class="side a-collapse short ">
        <a class="ul-text  fnt-mxs"><i class="fas fa-tachometer-alt mr-1"></i> صفحه
            <!-- <span class="badge badge-info">4</span> -->
            <i class="fas fa-chevron-down arrow"></i></a>
        <div class="side-item-container hide animated">
            <li class="side-item "><a href="./" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>پنل
                    کاربری</a>
            </li>
            <li class="side-item"><a href="./dark.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>پنل
                    کاربری تاریک</a>
            </li>
            <li class="side-item"><a href="./Login.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>صفحه
                    ورود</a></li>
            <li class="side-item"><a href="./glogin.html"><i class="fas fa-angle-right mr-2"></i>صفحه ورود رنگی</a></li>

        </div>
    </ul>

    <ul class="side a-collapse short">
        <a class="ul-text  fnt-mxs"><i class="fas fa-cog mr-1"></i> شخصی سازی
            <!-- <span	class="badge badge-success">4</span> -->
            <i class="fas fas fa-chevron-down arrow"></i></a>
        <div class="side-item-container hide animated">
            <li class="side-item"><a href="./color.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>رنگ</a>
            </li>
            <li class="side-item"><a href="./typo.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>تایپوکرافی</a></li>
            <li class="side-item"><a href="./dark-mode.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>حالت
                    شب</a></li>
            <li class="side-item"><a href="./rtl.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>راست
                    چین</a></li>
            <li class="side-item"><a href="./sidebar.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>ساید
                    بار</a></li>
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
            <li class="side-item"><a href="./alert.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>alert</a>
            </li>
            <li class="side-item"><a href="./badge.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Badge</a></li>
            <li class="side-item"><a href="./breadcrumb.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Breadcrumb</a></li>
            <li class="side-item"><a href="./button.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Button</a></li>
            <li class="side-item"><a href="./card.html" class="fnt-mxs"><i class="fas fa-angle-right mr-2"></i>Card</a>
            </li>
            <li class="side-item"><a href="./collapse.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Collapse</a></li>
            <li class="side-item"><a href="./Input.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Input</a></li>
            <li class="side-item"><a href="./jumborton.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Jumborton</a></li>
            <li class="side-item"><a href="./pagination.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Pagination</a></li>
            <li class="side-item"><a href="./progress.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Progress</a></li>
        </div>
    </ul>
    <ul class="side a-collapse short">
        <a class="ul-text  fnt-mxs"><i class="fas fa-layer-group mr-1"></i>کامپوننت های اضافی
            <!-- <span class="badge badge-warning">6</span> -->
            <i class="fas fas fa-chevron-down arrow"></i></a>
        <div class="side-item-container hide animated">
            <li class="side-item"><a href="./modal.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Modal</a></li>
            <li class="side-item"><a href="./toast.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Toast</a></li>
            <li class="side-item"><a href="./widget.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Widget</a></li>
            <li class="side-item"><a href="./Chart.html" class="fnt-mxs"><i
                        class="fas fa-angle-right mr-2"></i>Chart</a></li>

        </div>
    </ul>

    <p class="side-comment  fnt-mxs">پشتیبانی</p>
    <li class="side a-collapse short ">
        <a href="https://github.com/MajidAlinejad/Nozha-rtl-Dashboard" class="side-item  fnt-mxs "><i
                class=" fab fa-github mr-1"></i>GitHub</a>
    </li>
    <li class="side a-collapse short ">
        <a href="https://github.com/MajidAlinejad/Nozha-rtl-Dashboard" class="side-item  fnt-mxs "><i
                class=" far fa-question-circle mr-1"></i>گزارش باگ</a>
    </li>
    <li class="side a-collapse short ">
        <a href="https://github.com/MajidAlinejad/Nozha-rtl-Dashboard" class="side-item  fnt-mxs "><i
                class=" far fa-life-ring mr-1"></i>حل مشکل</a>
    </li>

    <p class="side-comment  fnt-mxs">اهدا</p>
    <li class="side a-collapse short pb-5">
        <a href="https://donateon.ir/alinejad.mj" class="side-item  fnt-mxs "><i class=" fas fa-coffee mr-1"></i>کمک
            به توسعه دهنده </a>
    </li>


</div>
