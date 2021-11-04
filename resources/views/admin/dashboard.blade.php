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
                                    <h4 class="card-title">{{__('labels.order_by_state')}}</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChartEx" class="doughnut-chart-ex chartjs" data-height="275"></canvas>


                                </div>

                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-between ">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-hourglass-half font-medium-2" style='color: #FDAC34'></i>
                                                <span class="font-weight-bold ml-75 mr-25">{{__('labels.pending_orders')}}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between ">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check font-medium-2" style='color: #28dac6'></i>
                                                <span class="font-weight-bold ml-75 mr-25">{{__('labels.successful_orders')}}</span>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-between ">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-times-circle font-medium-2" style='color: #EA5455'></i>
                                                <span class="font-weight-bold ml-75 mr-25">{{__('labels.canceled_orders')}}</span>
                                            </div>
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
                                labels: ['{{__('labels.pending_orders')}}', '{{__('labels.successful_orders')}}','{{__('labels.canceled_orders')}}'],
                                data: {{0}},
                                backgroundColor: [warningLightColor,successColorShade, window.colors.solid.danger],
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
