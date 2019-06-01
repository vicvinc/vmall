<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{ Auth::user()->name }}</a>
    <span class="navbar-text w-100 text-md-right">欢迎来到vMall管理后台</span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link "href="{{url('/logout')}}">
                <i class="fa fa-fw fa-sign-out"></i> 注销
            </a>
        </li>
    </ul>
</nav>
