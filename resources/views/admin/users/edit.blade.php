@extends('admin.layouts.app')

@section('title',trans_choice('labels.user',2))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('actions.edit')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.users.index')}}">{{__('labels.list',['name'=> trans_choice('labels.user',2)])}}</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        {{__('actions.edit')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="row" id="table-head">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button title="{{__('actions.back')}}" onclick="document.location = '{{url()->previous()}}'" type="button" class="btn btn-icon btn-outline-info">
                                    <i data-feather='arrow-right'></i>
                                </button>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{__('actions.edit')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form form-horizontal" method="post" action="{{route('admin.users.update', $user->id)}}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <x-form.input
                                                        name="name" {{-- required --}}
                                                        type="text" {{-- optional default=text --}}
                                                        :is-required="true" {{-- optional default=false --}}
                                                        :value="$user->name" {{-- optional default=null --}}
                                                    ></x-form.input>

                                                    <x-form.input
                                                        name="email" {{-- required --}}
                                                    type="email" {{-- optional default=text --}}
                                                        :is-required="true" {{-- optional default=false --}}
                                                        :value="$user->email" {{-- optional default=null --}}
                                                    ></x-form.input>

                                                    <x-form.input
                                                        name="phone"
                                                        type="text"
                                                        :value="$user->phone"
                                                        :is_required="true" {{-- optional default=false --}}
                                                    ></x-form.input>

                                                    <x-form.input
                                                    name="country_code"
                                                        type="text"
                                                        :value="$user->country_code"
                                                    :is_required="true" {{-- optional default=false --}}
                                                    ></x-form.input>
                                                    <x-form.input
                                                    name="codeC"
                                                        type="text"
                                                        :value="$user->codeC"
                                                    :is_required="false" {{-- optional default=false --}}
                                                    ></x-form.input>

                                                    <x-form.select
                                                        name="state" {{-- required --}}
                                                        :value="$user->state" {{-- optional default=null --}}
                                                        :is_required="true" {{-- optional default=false --}}
                                                        :options="[__('labels.active') => '1', __('labels.inactive') => '2']" {{-- optional default=[] --}}>

                                                    </x-form.select>

                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1">{{__('labels.save')}}</button>
                                                </div>
                                            </div>
                                        </form>
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

