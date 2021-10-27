<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#">
{{--                    <span class="brand-logo">--}}
{{--                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                 xmlns:xlink="http://www.w3.org/1999/xlink" height="24">--}}
{{--                                <defs>--}}
{{--                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"--}}
{{--                                                    y2="89.4879456%">--}}
{{--                                        <stop stop-color="#000000" offset="0%"></stop>--}}
{{--                                        <stop stop-color="#FFFFFF" offset="100%"></stop>--}}
{{--                                    </lineargradient>--}}
{{--                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">--}}
{{--                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>--}}
{{--                                        <stop stop-color="#FFFFFF" offset="100%"></stop>--}}
{{--                                    </lineargradient>--}}
{{--                                </defs>--}}
{{--                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">--}}
{{--                                        <g id="Group" transform="translate(400.000000, 178.000000)">--}}
{{--                                            <path class="text-primary" id="Path"--}}
{{--                                                  d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"--}}
{{--                                                  style="fill:currentColor"></path>--}}
{{--                                            <path id="Path1"--}}
{{--                                                  d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"--}}
{{--                                                  fill="url(#linearGradient-1)" opacity="0.2"></path>--}}
{{--                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997"--}}
{{--                                                     points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>--}}
{{--                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994"--}}
{{--                                                     points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>--}}
{{--                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"--}}
{{--                                                     points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                </g>--}}
{{--                            </svg></span>--}}
                    <h2 class="brand-text">O-TRAVEL</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content overflow-hidden">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @can('view-dashboard')
                <li class=" nav-item {{request()->routeIs('admin.dashboard*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="menu-title text-truncate" data-i18n="dashboard">
                        {{__('labels.dashboard')}}
                    </span>
                    </a>
                </li>
            @endcan

            @can('view-benefit')
                <li class=" nav-item {{request()->routeIs('admin.benefit*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.benefit')}}">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="menu-title text-truncate" data-i18n="benefit">
                    {{__('labels.benefit')}}
                </span>
                    </a>
                </li>
            @endcan

            @canany(['view-role','view-admin','view-user'])
                <li class="nav-item has-sub @if(request()->is(['admin/roles*','admin/users*','admin/admins*','admin/sellers*'])) sidebar-group-active open @endif" >
                    <a href="#" class="d-flex align-items-center">
                        <i class="fas fa-user-circle"></i>
                        <span class="menu-title text-truncate">
                            {{trans_choice('labels.accounts',1)}}
                        </span>
                    </a>

                    <ul class="menu-content">

                        @can('view-admin')
                            <li class="nav-item">
                                <a href="{{route('admin.admins.index')}}"
                                   class="nav-link {{request()->routeIs('admin.admins*') ? 'active' : ''}}"
                                   data-link="/admin/admins">
                                    <i class="fas fa-users-cog"></i>
                                    <span class="menu-title text-truncate">{{trans_choice('labels.admin',3)}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('view-role')
                            <li class="nav-item">
                                <a href="{{route('admin.roles.index')}}" data-link="/admin/roles"
                                   class="nav-link {{request()->routeIs('admin.roles*')? 'active' : ''}} ">
                                    <i class="fas fa-user-tag"></i>
                                    <span class="menu-title text-truncate">{{trans_choice('labels.role',3)}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('view-user')
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}" data-link="/admin/users"
                                   class="nav-link {{request()->routeIs('admin.users*') ? 'active' : ''}}">
                                    <i class="fas fa-users"></i>
                                    <span class="menu-title text-truncate">{{trans_choice('labels.user',2)}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('view-seller')
                            <li class="nav-item">
                                <a href="{{route('admin.sellers.index')}}" data-link="/admin/users"
                                   class="nav-link {{request()->routeIs('admin.sellers*') ? 'active' : ''}}">
                                    <i class="fas fa-users"></i>
                                    <span class="menu-title text-truncate">{{trans_choice('labels.seller',2)}}</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanany

            @can('view-tag')
                <li class=" nav-item {{request()->routeIs('admin.tags*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.tags.index')}}">

                        <i class="fas fa-hashtag"></i>
                        <span class="menu-title text-truncate">
                        {{trans_choice('labels.tag',2)}}
                    </span>
                    </a>
                </li>
            @endcan

            @can('view-admin-notification')
                <li class=" nav-item {{request()->routeIs('admin.notifications*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.notifications.index')}}">

                        <i class="fas fa-bell"></i>
                        <span class="menu-title text-truncate">
                    {{trans_choice('labels.notification',2)}}
                </span>
                    </a>
                </li>
            @endcan

            @can('view-rate-tag')
                <li class=" nav-item {{request()->routeIs('admin.rate-tags*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.rate-tags.index')}}">

                        <i class="fas fa-hashtag"></i>
                        <span class="menu-title text-truncate">
                    {{trans_choice('labels.rate-tag',2)}}
                </span>
                    </a>
                </li>
            @endcan

            @can('view-product')
                <li class=" nav-item {{request()->routeIs('admin.products*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.products.index')}}">
                        <i class="fab fa-product-hunt"></i>
                        <span class="menu-title text-truncate">
                            {{trans_choice('labels.product',2)}}
                        </span>
                    </a>
                </li>
            @endcan

            @can('view-recipe')
                <li class=" nav-item {{request()->routeIs('admin.recipes*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.recipes.index')}}">
                        <i class="fas fa-file-invoice"></i>
                        <span class="menu-title text-truncate">{{trans_choice('labels.recipe',2)}}</span>
                    </a>
                </li>
            @endcan

            @canany(['view-report-category','view-report'])
                <li class="nav-item has-sub @if(request()->is(['admin/report-categories*','admin/reports*'])) sidebar-group-active open @endif" >
                    <a href="#" class="d-flex align-items-center">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="menu-title text-truncate">
                            {{trans_choice('labels.report',2)}}
                        </span>
                    </a>

                    <ul class="menu-content">

                        @can('view-report-category')
                            <li class=" nav-item {{request()->routeIs('admin.report-categories*') ? 'active' : ''}}">
                                <a class="d-flex align-items-center" href="{{route('admin.report-categories.index')}}">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span class="menu-title text-truncate">{{trans_choice('labels.report-category',2)}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('view-report')
                            <li class="nav-item">
                                <a href="{{route('admin.reports.index')}}" data-link="/admin/roles"
                                   class="nav-link {{request()->routeIs('admin.reports*')? 'active' : ''}} ">
                                    <i class="fas fa-clipboard"></i>
                                    <span class="menu-title text-truncate">{{trans_choice('labels.report',2)}}</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanany

            @canany(['view-user_withdrawal','view-seller_withdrawal'])
                <li class="nav-item has-sub @if(request()->is(['admin/user-withdrawals* ,view-seller-withdrawal*'])) sidebar-group-active open @endif" >
                <a href="#" class="d-flex align-items-center">
                    <i class="fas fa-money-check-alt"></i>
                    <span class="menu-title text-truncate">
                        {{trans_choice('labels.withdrawal',1)}}
                    </span>
                </a>

                <ul class="menu-content">

                    @can('view-seller_withdrawal')
                        <li class=" nav-item {{request()->routeIs('admin.seller-withdrawals*') ? 'active' : ''}}">
                            <a class="d-flex align-items-center" href="{{route('admin.seller-withdrawals.index')}}">
                                <i class="fas fa-money-check"></i>
                                <span class="menu-title text-truncate">{{trans_choice('labels.seller_withdrawal',2)}}</span>
                            </a>
                        </li>
                    @endcan

                    @can('view-user_withdrawal')
                        <li class="nav-item">
                            <a href="{{route('admin.user-withdrawals.index')}}" data-link="/admin/roles"
                               class="nav-link {{request()->routeIs('admin.user-withdrawals*')? 'active' : ''}} ">
                                <i class="fas fa-money-check"></i>
                                <span class="menu-title text-truncate">{{trans_choice('labels.user_withdrawal',1)}}</span>
                            </a>
                        </li>
                    @endcan



                </ul>
            </li>
            @endcanany

            @can('view-code')
                <li class="nav-item">
                    <a href="{{route('admin.codes.index')}}" data-link="/admin/codes"
                       class="nav-link {{request()->routeIs('admin.code*')? 'active' : ''}} ">
                        <i class="fas fa-money-check"></i>
                        <span class="menu-title text-truncate">{{__('labels.code')}}</span>
                    </a>
                </li>
            @endcan

            @canany(['view-order','view-recipe-order'])
                <li class="nav-item has-sub @if(request()->is(['admin/orders* ,admin/recipe-orders*'])) sidebar-group-active open @endif" >
                    <a href="#" class="d-flex align-items-center">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span class="menu-title text-truncate">
                            {{trans_choice('labels.order',2)}}
                        </span>
                    </a>

                    <ul class="menu-content">

                        @can('view-order')
                            <li class="nav-item ">
                                <a href="{{route('admin.orders.index')}}" data-link="/admin/orders"
                                   class="nav-link {{request()->routeIs('admin.orders*') ? 'active' : ''}}">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                    <span class="menu-title text-truncate">{{trans_choice('labels.food_order',1)}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('view-recipe-order')
                            <li class="nav-item">
                                <a href="{{route('admin.recipe-orders.index')}}"
                                   class="nav-link {{request()->routeIs('admin.recipe-orders*')? 'active' : ''}} ">
                                    <i class="fas fa-file-invoice"></i>
                                    <span class="menu-title text-truncate">{{__('labels.recipe_orders')}}</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanany

        </ul>
    </div>
</div>
