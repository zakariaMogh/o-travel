@extends('admin.layouts.app')

@section('title',trans_choice('labels.report',2))

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
                                        <a href="{{route('admin.reports.index')}}">{{__('labels.list',['name'=> trans_choice('labels.report',2)])}}</a>
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
                <div class="row" id="table-head">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <button title="{{__('actions.back')}}"
                                        onclick="document.location = '{{url()->previous()}}'" type="button"
                                        class="btn btn-icon btn-outline-danger">
                                    <i data-feather='arrow-right'></i>
                                </button>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{__('actions.show')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                            <div class="mt-md-0 mt-2">
                                                <h4 class="invoice-title">
                                                    {{__('labels.name')}} :
                                                    <span class="invoice-number">{{$report->subject}}</span>
                                                </h4>
                                                <h4 class="invoice-title">
                                                    {{__('labels.message')}} :
                                                    <span class="invoice-number">{{$report->message}}</span>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

