@extends('admin.layouts.app')

@section('title',trans_choice('labels.country',2))
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/admin/app-assets/vendors/css/forms/select/select2.min.css')}}">
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
                            <h2 class="content-header-title float-left mb-0">{{__('actions.edit')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.countries.index')}}">{{__('labels.list',['name'=> trans_choice('labels.country',2)])}}</a>
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
                                        <form class="form form-horizontal" method="post" action="{{route('admin.countries.update', $country->id)}}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <x-form.input
                                                        name="name" {{-- required --}}
                                                    type="text" {{-- optional default=text --}}
                                                        :is-required="true" {{-- optional default=false --}}
                                                        :value="$country->name" {{-- optional default=null --}}
                                                    />
                                                    <div class="form-group">
                                                        <label for="categories">{{trans_choice('labels.category',3)}}</label>
                                                        <select
                                                            class="custom-select @error('categories') is-invalid @enderror"
                                                            id="categories"
                                                            name="categories[]" multiple>
                                                            @foreach($country->categories as $category)
                                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('categories')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
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

@push('js')
    <script src="{{asset('assets/admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    <script>
        $('#categories').select2({
            cache:true,
            ajax: {
                delay: 250,
                url: '{{route('admin.categories.index')}}',
                dataType: 'json',
                data: function (params) {
                    // Query parameters will be ?search=[term]&page=[page]

                    return {
                        search: params.term,
                        page: params.page || 1
                    };


                },
                processResults: function ({categories}, params) {
                    params.page = params.page || 1;

                    let fData = $.map(categories.data, function (obj) {
                        obj.text = obj.name; // replace name with the property used for the text
                        return obj;
                    });

                    return {
                        results: fData,
                        pagination: {
                            more: (params.page * 10) < categories.total
                        }
                    };
                }
            }
        })
    </script>
@endpush
