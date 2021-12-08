@extends('admin.layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/assets/css/style-rtl.css')}}">

@endpush

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                    {{--                        <!-- Greetings Card starts -->--}}
                    {{--                        <div class="col-lg-6 col-md-12 col-sm-12">--}}
                    {{--                            <div class="card card-congratulations">--}}
                    {{--                                <div class="card-body text-center">--}}
                    {{--                                    <img src="{{asset('assets/admin/app-assets/images/elements/decore-left.png')}}" class="congratulations-img-left" alt="card-img-left" />--}}
                    {{--                                    <img src="{{asset('assets/admin/app-assets/images/elements/decore-right.png')}}" class="congratulations-img-right" alt="card-img-right" />--}}
                    {{--                                    <div class="avatar avatar-xl bg-primary shadow">--}}
                    {{--                                        <div class="avatar-content">--}}
                    {{--                                            <i data-feather="award" class="font-large-1"></i>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="text-center">--}}
                    {{--                                        <h1 class="mb-1 text-white">Dashboard coming soon</h1>--}}
                    {{--                                        <p class="card-text m-auto w-75">--}}

                    {{--                                        </p>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <!-- Greetings Card ends -->--}}
                    <!-- Subscribers Chart Card starts -->
                        <div class="col-md-6 ">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-primary p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fas fa-users-cog font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="font-weight-bolder mt-1">{{$users_count}}</h2>
                                            <p class="card-text">{{trans_choice('labels.user',2)}}</p>
                                        </div>
                                        <div id="gained-chart"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-primary p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fas fa-users-cog font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="font-weight-bolder mt-1">{{$companies_count}}</h2>
                                            <p class="card-text">{{trans_choice('labels.company',2)}}</p>
                                        </div>
                                        <div id="gained-chart"></div>
                                    </div>
                                </div>
                                <!-- Subscribers Chart Card ends -->

                                <!-- Subscribers Chart Card starts -->
                                <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-warning p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fas fa-sitemap font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="font-weight-bolder mt-1">{{$categories_count}}</h2>
                                            <p class="card-text">{{trans_choice('labels.category',2)}}</p>
                                        </div>
                                        <div id="gained-chart"></div>
                                    </div>
                                </div>
                                <!-- Subscribers Chart Card ends -->

                                <!-- Orders Chart Card starts -->
                                <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-warning p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fas fa-flag font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="font-weight-bolder mt-1">{{$domains_count}}</h2>
                                            <p class="card-text">{{trans_choice('labels.domain',2)}}</p>
                                        </div>
                                        <div id="order-chart"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-warning p-50 m-0">
                                                <div class="avatar-content">

                                                    <i class="fas fa-city font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="font-weight-bolder mt-1">{{$cities_count}}</h2>
                                            <p class="card-text">{{trans_choice('labels.city',2)}}</p>
                                        </div>
                                        <div id="order-chart"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-warning p-50 m-0">
                                                <div class="avatar-content">
                                                    <i class="fas fa-globe-europe font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="font-weight-bolder mt-1">{{$countries_count}}</h2>
                                            <p class="card-text">{{trans_choice('labels.country',2)}}</p>
                                        </div>
                                        <div id="order-chart"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Orders Chart Card ends -->
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('labels.offer_by_type')}}</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChartEx" class="doughnut-chart-ex chartjs" data-height="275"></canvas>
                                </div>

                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">

                                        <div class="d-flex justify-content-between ">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check-double font-medium-2" style='color: #28dac6'></i>
                                                <span class="font-weight-bold ml-75 mr-25">{{__('labels.featured_offers')}}</span>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-between ">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check font-medium-2" style='color: #EA5455'></i>
                                                <span class="font-weight-bold ml-75 mr-25">{{__('labels.normal_offers')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">

                            <div class="card">

                                <div class="card-header ">

                                </div>

                                <div class="card-body">
                                    <div class="card-tools">
                                        <form id="filter-form">
                                            <div class="row justify-content-end">

                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>{{trans_choice('labels.image', 1)}}</th>
                                                <th>{{trans_choice('labels.company',1)}}</th>

                                                {{--                                            <th>{{__('labels.wallet')}}</th>--}}
                                                <th>{{__('labels.certified')}}</th>
                                                <th>{{__('labels.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($companies as $company)
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal-{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">{{__('labels.trade_register')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="{{$company->trade_register_url}}" alt="" width="100%">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{route('admin.companies.check',$company->id)}}" class="btn btn-success" >{{__('actions.approved')}}</a>
                                                                <a href="{{route('admin.companies.uncheck',$company->id)}}" class="btn btn-danger" >{{__('actions.disapproved')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <tr>

                                                    <td>
                                                    <span class="avatar">
                                                                 <img src="{{$company->image_url}}" class="round" height="50"
                                                                      width="50" alt="{{$company->name}} logo"/>
                                                    </span>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>{{$company->name}}</li>
                                                            <li style="direction: ltr"><a href="tel:{{$company->full_phone}}">{{$company->full_phone}}</a></li>
                                                            <li><a href="mailto:{{$company->email}}">{{$company->email}}</a></li>
                                                        </ul>
                                                    </td>

                                                    <td>
                                                        @switch($company->checked)
                                                            @case(true)
                                                            <span
                                                                class="badge badge-pill badge-light-success mr-1">{{__('labels.yes')}}</span>
                                                            @break
                                                            @case(false)
                                                            <span
                                                                class="badge badge-pill badge-light-danger mr-1">{{__('labels.no')}}</span>
                                                            @break
                                                            @default
                                                            <span
                                                                class="badge badge-pill badge-light-success mr-1">{{__('labels.no')}}
                                                        </span>
                                                        @endswitch
                                                    </td>
                                                    <td>

                                                        @can('view-company')
                                                            <a title="{{__('actions.details')}}"
                                                               href="javascript:void(0)" data-toggle="modal" data-target="#modal-{{$company->id}}">
                                                                <i data-feather="eye" class="mr-50"></i>
                                                            </a>

                                                        @endcan

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center my-1">
                                            <a href="{{route('admin.requests.companies')}}">{{__('home.view-all')}}</a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-6 col-12">

                            <div class="card">

                                <div class="card-header ">


                                </div>

                                <div class="card-body">
                                    <div class="card-tools">

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>{{__('labels.name')}}</th>
                                                <th>{{__('labels.date')}}</th>
                                                {{--                                            <th>{{__('labels.wallet')}}</th>--}}
                                                <th>{{__('labels.price')}}</th>
                                                <th>{{trans_choice('labels.company',1)}}</th>
                                                <th>{{__('labels.featured')}}</th>
                                                <th>{{__('labels.state')}}</th>
                                                <th>{{__('labels.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($latestOffers as $offer)
                                                <tr>
                                                    <td>
                                                        {{$offer->name}}
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">{{$offer->date ? $offer->date->format('m/d/Y') : __('labels.empty')}}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{money($offer->price)}}</span>
                                                    </td>
                                                    {{--                                                <td>--}}
                                                    {{--                                                    {{money($u->wallet)}}--}}
                                                    {{--                                                </td>--}}
                                                    <td>
                                                        <a class="text-decoration-none" href="{{route('admin.companies.show',$offer->company_id)}}">
                                                            {{$offer->company->name}}
                                                        </a>
                                                    </td>



                                                    <td>
                                                        @if($offer->featured === 2)
                                                            <span class="badge badge-success">
                                                        {{__('labels.yes')}}
                                                    </span>
                                                        @else
                                                            <span class="badge badge-danger">
                                                        {{__('labels.no')}}
                                                    </span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($offer->state === 2)
                                                            <span class="badge badge-success">
                                                        {{__('labels.states.2')}}
                                                    </span>
                                                        @else
                                                            <span class="badge badge-danger">
                                                        {{__('labels.states.1')}}
                                                    </span>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        @can('view-offer')
                                                            <a title="{{__('actions.details')}}"
                                                               href="{{route('admin.offers.show',$offer->id)}}">
                                                                <i data-feather="eye" class="mr-50"></i>
                                                            </a>
                                                        @endcan

                                                        @can('edit-offer')
                                                            <a title="{{__('actions.edit')}}"
                                                               href="{{route('admin.offers.edit',$offer->id)}}">
                                                                <i data-feather="edit-2" class="mr-50"></i>
                                                            </a>
                                                        @endcan


                                                        @can('delete-offer')
                                                            <a title="{{__('actions.delete')}}"
                                                               onclick="deleteForm({{$offer->id}})" href="javascript:void(0);">
                                                                <i data-feather="trash" class="mr-50"></i>
                                                            </a>
                                                        @endcan




                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center my-1">
                                            <a href="{{route('admin.offers.index')}}">{{__('home.view-all')}}</a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                    <!--/ List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('assets/admin/app-assets/vendors/js/charts/chart.min.js')}}"></script>

    <script>
        $(window).on('load', function () {

            var chartWrapper = $('.chartjs'),
                flatPicker = $('.flat-picker'),
                barChartEx = $('.bar-chart-ex'),
                horizontalBarChartEx = $('.horizontal-bar-chart-ex'),
                lineChartEx = $('.line-chart-ex'),
                radarChartEx = $('.radar-chart-ex'),
                polarAreaChartEx = $('.polar-area-chart-ex'),
                bubbleChartEx = $('.bubble-chart-ex'),
                doughnutChartEx = $('.doughnut-chart-ex'),
                scatterChartEx = $('.scatter-chart-ex'),
                lineAreaChartEx = $('.line-area-chart-ex');

            // Color Variables
            var primaryColorShade = '#836AF9',
                yellowColor = '#ffe800',
                successColorShade = '#28dac6',
                warningColorShade = '#ffe802',
                warningLightColor = '#FDAC34',
                infoColorShade = '#299AFF',
                greyColor = '#4F5D70',
                blueColor = '#2c9aff',
                blueLightColor = '#84D0FF',
                greyLightColor = '#EDF1F4',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                lineChartPrimary = '#666ee8',
                lineChartDanger = '#ff4961',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

            // Detect Dark Layout
            if ($('html').hasClass('dark-layout')) {
                labelColor = '#b4b7bd';
            }


            // Wrap charts with div of height according to their data-height
            if (chartWrapper.length) {
                chartWrapper.each(function () {
                    $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
                });
            }
            // --------------------------------------------------------------------
            if (doughnutChartEx.length) {
                var doughnutExample = new Chart(doughnutChartEx, {
                    type: 'doughnut',
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        cutoutPercentage: 60,
                        legend: { display: false },
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    var label = data.datasets[0].labels[tooltipItem.index] || '',
                                        value = data.datasets[0].data[tooltipItem.index];
                                    var output = ' ' + label + ' : ' + value + ' %';
                                    return output;
                                }
                            },
                            // Updated default tooltip UI
                            shadowOffsetX: 1,
                            shadowOffsetY: 1,
                            shadowBlur: 8,
                            shadowColor: tooltipShadow,
                            backgroundColor: window.colors.solid.white,
                            titleFontColor: window.colors.solid.black,
                            bodyFontColor: window.colors.solid.black
                        }
                    },
                    data: {
                        datasets: [
                            {
                                labels: ['{{__('labels.featured_offers')}}', '{{__('labels.normal_offers')}}'],
                                data: [{{$normal_offers}},{{$featured_offers}}],
                                backgroundColor: [successColorShade, window.colors.solid.danger],
                                borderWidth: 0,
                                pointStyle: 'rectRounded'
                            }
                        ]
                    }
                });
            }
        })

    </script>
@endpush
