@extends('admin.layouts.app')

@section('title',trans_choice('labels.company',2))

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
                                        <a href="{{route('admin.companies.index')}}">{{__('labels.list',['name'=> trans_choice('labels.company',2)])}}</a>
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
                                        <form class="form form-horizontal" method="post" action="{{route('admin.companies.update', $company->id)}}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="auto_accepted">{{__('labels.auto_accepted')}}</label>
                                                        <select name="auto_accepted" id="auto_accepted" class="form-control">
                                                            <option value="1" @if((int)old('auto_accepted',$company->auto_accepted) === 1) selected @endif>{{__('labels.no')}}</option>
                                                            <option value="2" @if((int)old('auto_accepted',$company->auto_accepted) === 2) selected @endif>{{__('labels.yes')}}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="auto_accepted">{{__('labels.story_state')}}</label>
                                                        <select name="story_state" id="story_state" class="form-control">
                                                            <option value="1" @if((int)old('story_state',$company->story_state) === 1) selected @endif>{{__('labels.enable')}}</option>
                                                            <option value="2" @if((int)old('story_state',$company->story_state) === 2) selected @endif>{{__('labels.disabled')}}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="SML_visibility">{{__('labels.social_media_links_visibility')}}</label>
                                                        <select name="SML_visibility" id="SML_visibility" class="form-control">
                                                            <option value="1" @if((int)old('SML_visibility',$company->SML_visibility) === 1) selected @endif>{{__('labels.no')}}</option>
                                                            <option value="2" @if((int)old('SML_visibility',$company->SML_visibility) === 2) selected @endif>{{__('labels.yes')}}</option>
                                                        </select>
                                                    </div>

                                                    <x-form.input
                                                        name="max_number_of_offers" {{-- required --}}
                                                        :value="old('max_number_of_offers',$company->max_number_of_offers)"
                                                        type="integer" {{-- optional default=text --}}
                                                        :is_required="true" {{-- optional default=false --}}
                                                    />
                                                    <x-form.input
                                                        name="codeC" {{-- required --}}
                                                        :value="old('codeC',$company->codeC)"
                                                        type="text" {{-- optional default=text --}}
                                                        :is_required="false" {{-- optional default=false --}}
                                                    />

                                        
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

