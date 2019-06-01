<nav id="side-menu" class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                    <span data-feather="home"></span>
                    控制台 <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link {{ request()->is('admin/order*') ? 'active' : '' }}"
                    href="{{url('admin/order')}}"
                >
                    <span data-feather="file"></span>
                    订单
                </a>
            </li>
            {{--  商品管理  --}}
            <li class="nav-item"
                data-toggle="tooltip"
                data-placement="right"
                title="sales"
                data-original-title="sales"
            >
                <a class="nav-link nav-link-collapse collapsed {{request()->is('admin/product/*') ? 'active' : ''}}"
                    data-toggle="collapse"
                    href="#goods_manage"
                    data-parent="#exampleAccordion"
                    aria-expanded="false"
                >
                    <span data-feather="shopping-cart"></span>
                    <span class="nav-link-text">出售</span>
                </a>
                <div
                    id="goods_manage"
                    class="sidenav-second-level collapse {{request()->is('admin/product/*') ? 'show' : ''}}"
                >
                    <a
                        class="list-group-item {{request()->is('admin/product/goods*') ? 'active' : ''}}"
                        href="{{url('admin/product/goods')}}"
                    >
                        商品
                    </a>
                    <a
                        class="list-group-item {{request()->is('admin/product/topic*') ? 'active' : ''}}"
                        href="{{url('admin/product/topic')}}"
                    >
                        专题
                    </a>
                    <a
                        class="list-group-item {{request()->is('admin/product/plate*') ? 'active' : ''}}"
                        href="{{url('admin/product/plate')}}"
                    >
                        板块
                    </a>
                    <a
                        class="list-group-item {{request()->is('admin/product/category*') ? 'active' : ''}}"
                        href="{{url('admin/product/category')}}"
                    >
                        分类
                    </a>
                </div>
            </li>
            {{--  公众号管理  --}}
            <li class="nav-item"
                data-toggle="tooltip"
                data-placement="right"
                title=""
                data-original-title="Example Pages"
            >
                <a class="nav-link nav-link-collapse collapsed {{request()->is('admin/wechat/*') ? 'active' : ''}}"
                    data-toggle="collapse"
                    href="#wechat_manage"
                    data-parent="#exampleAccordion"
                    aria-expanded="false"
                >
                    <i class="icon icon-wechat"></i>
                    <span class="nav-link-text">公众号</span>
                </a>
                <div
                    id="wechat_manage"
                    class="sidenav-second-level collapse {{request()->is('admin/wechat/*') ? 'show' : ''}}" 
                >
                    <a
                        class="list-group-item {{request()->is('admin/wechat/menu*') ? 'active' : ''}}"
                        href="{{url('admin/wechat/menu')}}"
                    >
                        菜单设置
                    </a>
                    <a
                        class="list-group-item {{request()->is('admin/wechat/follower') ? 'active' : ''}}"
                        href="{{url('admin/wechat/follower')}}"
                    >
                        粉丝列表
                    </a>
                </div>
            </li>
            <li class="nav-item"
                data-toggle="tooltip"
                data-placement="right"
                title="shopconfig"
                data-original-title="shopconfig"
            >
                <a class="nav-link nav-link-collapse collapsed {{request()->is('admin/shop/*') ? 'active' : ''}}"
                    data-toggle="collapse"
                    href="#shop_config"
                    data-parent="#exampleAccordion"
                    aria-expanded="false"
                >
                    <span data-feather="layers"></span>
                    <span class="nav-link-text">店铺</span>
                </a>
                <div
                    id="shop_config"
                    class="sidenav-second-level collapse {{request()->is('admin/shop/*') ? 'show' : ''}}" 
                >
                    <a
                        class="list-group-item {{request()->is('admin/shop/config') ? 'active' : ''}}"
                        href="{{url('admin/shop/config')}}"
                    >
                        商铺配置
                    </a>
                    <a
                        class="list-group-item {{request()->is('admin/shop/banner*') ? 'active' : ''}}"
                        href="{{url('admin/shop/banner')}}"
                    >
                        轮播图
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                </a>
            </li>
        </ul>
    </div>
</nav>
