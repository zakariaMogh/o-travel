@extends('admin.layouts.app')

@push('css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/app-assets/vendors/css/maps/leaflet.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin//app-assets/css-rtl/plugins/maps/map-leaflet.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/app-assets/css-rtl/pages/app-user.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/app-assets/css-rtl/plugins/extensions/ext-component-ratings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/app-assets/vendors/css/extensions/jquery.rateyo.min.css')}}">
@endpush

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('actions.show')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.companies.index')}}">{{__('labels.list',['name'=> trans_choice('labels.company',3)])}}</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        {{__('actions.show')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <section class="app-user-view">
                    <!-- User Card starts-->
                    <div class="col-md-12">
                        <div class="card user-card">
                            <div class="card-header">
                                <button title="{{__('actions.back')}}"
                                        onclick="document.location = '{{url()->previous()}}'" type="button"
                                        class="btn btn-icon btn-outline-info">
                                    <i data-feather='arrow-right'></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                        <div class="user-avatar-section">
                                            <div class="d-flex justify-content-start">
                                                <img class="img-fluid rounded" src="{{$company->image_url}}"
                                                     height="104" width="104" alt="User avatar"/>
                                                <div class="d-flex flex-column ml-1">
                                                    <div class="user-info mb-1">
                                                        <h4 class="mb-0">{{$company->name}}</h4>
                                                        <span class="card-text">{{$company->full_phone}}</span>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        @can('edit-company')
                                                            <button class="btn btn-outline-warning ml-1"
                                                                    @if($company->checked)
                                                                    title="{{__('labels.uncheck')}}"
                                                                    @else
                                                                        title="{{__('labels.certified')}}"
                                                                    @endif

                                                                    onclick="checkUncheck({{$company->id}})">
                                                               @if($company->checked)
                                                                    <i data-feather='x'></i>
                                                                @else
                                                                    <i data-feather='check'></i>
                                                                @endif
                                                            </button>

                                                            <button class="btn btn-outline-info ml-1"
                                                                    @if($company->state === 1)
                                                                    title="{{__('labels.inactive')}}"
                                                                    @else
                                                                    title="{{__('labels.active')}}"
                                                                    @endif

                                                                    onclick="activeInactive({{$company->id}})">
                                                                @if($company->state === 1)
                                                                    <i data-feather='user-x'></i>
                                                                @else
                                                                    <i data-feather='user-check'></i>
                                                                @endif
                                                            </button>
                                                        @endcan
                                                        @can('delete-company')
                                                            <button class="btn btn-outline-danger ml-1"
                                                                    onclick="deleteForm({{$company->id}})">
                                                                <i data-feather='trash-2'></i>
                                                            </button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6  col-lg-6 mt-3 mt-xl-0">
                                        <div class="user-info-wrapper">
                                            <div class="d-flex flex-wrap">
                                                <div class="user-info-title">
                                                    <i data-feather="info" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.name')}}</span>
                                                </div>
                                                <p class="card-text mb-0">{{$company->name}}</p>
                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="mail" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.email')}}</span>
                                                </div>
                                                <p class="card-text mb-0">{{$company->email}}</p>
                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="phone" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.phone')}}</span>
                                                </div>
                                                <p class="card-text mb-0" style="direction: ltr">{{$company->full_phone}}</p>
                                            </div>

{{--                                            <div class="d-flex flex-wrap my-50">--}}
{{--                                                <div class="user-info-title">--}}
{{--                                                    <i data-feather="dollar-sign" class="mr-1"></i>--}}
{{--                                                    <span--}}
{{--                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.wallet')}}</span>--}}
{{--                                                </div>--}}
{{--                                                <p class="card-text mb-0">{{money($company->wallet)}}</p>--}}
{{--                                            </div>--}}

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="info" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.state')}}</span>
                                                </div>
                                                <p class="card-text mb-0">
                                                    @switch($company->state)
                                                        @case(1)
                                                        <span
                                                            class="badge badge-pill badge-light-success mr-1">{{__('labels.active')}}</span>
                                                        @break
                                                        @case(2)
                                                        <span
                                                            class="badge badge-pill badge-light-danger mr-1">{{__('labels.inactive')}}</span>
                                                        @break
                                                        @default
                                                        <span
                                                            class="badge badge-pill badge-light-success mr-1">{{__('labels.active')}}</span>
                                                    @endswitch
                                                </p>
                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="check" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.certified')}}</span>
                                                </div>
                                                <p class="card-text mb-0">
                                                    @switch($company->checked)
                                                        @case(1)
                                                        <span class="badge badge-pill badge-light-success mr-1">
                                                            {{__('labels.yes')}}
                                                        </span>
                                                        @break
                                                        @case(0)
                                                        <span class="badge badge-pill badge-light-danger mr-1">
                                                            {{__('labels.no')}}
                                                        </span>
                                                        @break
                                                        @default
                                                        <span
                                                            class="badge badge-pill badge-light-success mr-1">{{__('labels.no')}}
                                                        </span>
                                                    @endswitch
                                                </p>
                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="file-text" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.description')}}</span>
                                                </div>
                                                <p class="card-text mb-0">{{$company->description ?? __('labels.empty') }}</p>
                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="external-link" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.social_links')}}</span>
                                                </div>
                                                @if($company->facebook)
                                                <p class="card-text mb-0">
                                                    <a href="{{$company->facebook}}" target="_blank">
                                                        <i data-feather="facebook" class="mr-1"></i>
                                                    </a>
                                                </p>
                                                @endif
                                                @if($company->twitter)
                                                <p class="card-text mb-0">
                                                    <a href="{{$company->twitter}}" target="_blank">
                                                        <i data-feather="twitter" class="mr-1"></i>
                                                    </a>
                                                </p>
                                                @endif

                                                @if($company->instagram)
                                                    <p class="card-text mb-0">
                                                        <a href="{{$company->instagram}}" target="_blank">
                                                            <i data-feather="instagram" class="mr-1"></i>
                                                        </a>
                                                    </p>
                                                @endif

                                                @if($company->snapchat)
                                                    <p class="card-text mb-0">
                                                        <a href="{{$company->snapchat}}" target="_blank">
                                                            <i class="fab fa-snapchat-square mr-1"></i>
                                                        </a>
                                                    </p>
                                                @endif

                                                @if($company->twitter)
                                                    <p class="card-text mb-0">
                                                        <a href="{{$company->twitter}}" target="_blank">
                                                            <i data-feather="twitter" class="mr-1"></i>
                                                        </a>
                                                    </p>
                                                @endif

                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="map-pin" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.address')}}
                                                    </span>
                                                </div>
                                                <p class="card-text mb-0">
                                                    {{$company->address}}
                                                    @if($company->latitude && $company->longitude)
                                                        <!--a href="#mapModal"
                                                           data-latitude="{{$company->latitude}}"
                                                           data-longitude="{{$company->longitude}}"
                                                           data-address="{{$company->address}}"
                                                           data-city="{{$company->city}}"
                                                           data-toggle="modal"
                                                        >
                                                            <i data-feather='map'></i>
                                                        </a-->
                                                    @endif
                                                </p>

                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i class="fas fa-city mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{trans_choice('labels.city',1)}}</span>
                                                </div>
                                                <p class="card-text mb-0">{{$company->city->name ?? __('labels.empty')}}</p>
                                            </div>

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="calendar" class="mr-1"></i>
                                                    <span
                                                        class="card-text user-info-title font-weight-bold mb-0">{{__('labels.created_at')}}</span>
                                                </div>
                                                <p class="card-text mb-0">{{$company->created_at->format('m-d-Y')}}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div id="mapModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center mb-0">{{__('labels.Map')}}</h3>
                    <button type="button" class="close float-right" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">&#xD7;</span>
                    </button>
                </div>

                <div class="modal-body p-0 text-center bg-alt">

                    <div id="map-container">
                        <div id="map">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-primary " data-dismiss="modal" aria-hidden="true">{{__('actions.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script src="{{asset('assets/admin/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <script src="{{asset('assets/admin/app-assets/vendors/js/maps/leaflet.min.js')}}"></script>
    <script src="{{asset('assets/admin/app-assets/vendors/js/extensions/jquery.rateyo.min.js')}}"></script>
    <script src="{{asset('assets/admin/app-assets/js/scripts/extensions/ext-component-ratings.js')}}"></script>
    <script>

        $('#mapModal').on('show.bs.modal', function (e)
        {
            setTimeout(function() {
                map.invalidateSize();
            }, 500);

            const latitude = $(e.relatedTarget).data('latitude');
            const longitude = $(e.relatedTarget).data('longitude');

            const labels_address = {!! json_encode(__('labels.address')) !!};
            const labels_city = {!! json_encode(trans_choice('labels.city',1)) !!};

            const map = L.map('map').setView([latitude, longitude], 6);
            L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
                maxZoom: 18
            }).addTo(map);

            const marker = L.marker([latitude, longitude]).addTo(map);
            marker.bindPopup(
                "<b>"+ labels_address + " : </b>" + $(e.relatedTarget).data('address') +
                "<br>" +
                "<b>"+ labels_city + " : </b>" + $(e.relatedTarget).data('city') +
                "<br>"
            );
        });

        $('#mapModal').on('hide.bs.modal', function (event)
        {

            $( '#map-container' ).html( ' ' ).append( '<div id="map"></div>' );

        })

        const checkUncheck = id => {
            Swal.fire({
                title: '{{__('actions.delete_confirm_title')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__('actions.delete_btn_yes')}}',
                cancelButtonText: '{{__('actions.delete_btn_cancel')}}'
            }).then((result) => {
                if (result.value) {
                    window.location = `/admin/companies/${id}/check-uncheck`;
                }
            });
        }

        const activeInactive = id => {
            Swal.fire({
                title: '{{__('actions.delete_confirm_title')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__('actions.delete_btn_yes')}}',
                cancelButtonText: '{{__('actions.delete_btn_cancel')}}'
            }).then((result) => {
                if (result.value) {
                    window.location = `/admin/companies/${id}/active-inactive`;
                }
            });
        }

        const deleteForm = id => {

            Swal.fire({
                title: '{{__('actions.delete_confirm_title')}}',
                text: "{{__('actions.delete_confirm_text')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__('actions.delete_btn_yes')}}',
                cancelButtonText: '{{__('actions.delete_btn_cancel')}}'
            }).then((result) => {
                if (result.value) {
                    createForm(id).submit();
                }
            });
        }
        const createForm = id => {
            let f = document.createElement("form");
            f.setAttribute('method', "post");
            f.setAttribute('action', `/admin/companies/${id}`);

            let i1 = document.createElement("input"); //input element, text
            i1.setAttribute('type', "hidden");
            i1.setAttribute('name', '_token');
            i1.setAttribute('value', '{{csrf_token()}}');

            let i2 = document.createElement("input"); //input element, text
            i2.setAttribute('type', "hidden");
            i2.setAttribute('name', '_method');
            i2.setAttribute('value', 'DELETE');

            f.appendChild(i1);
            f.appendChild(i2);
            document.body.appendChild(f);
            return f;
        }
    </script>
@endpush



