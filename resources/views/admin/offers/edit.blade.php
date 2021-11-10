@extends('admin.layouts.app')

@section('title',trans_choice('labels.offer',2))

@push('css')

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
                                        <a href="{{route('admin.offers.index')}}">{{__('labels.list',['name'=> trans_choice('labels.offer',2)])}}</a>
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
                                        <form class="form form-horizontal" method="post" action="{{route('admin.offers.update', $offer->id)}}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-12 mb-2">

                                                    <div id='form-container-company'>
                                                        <label for="company" >{{trans_choice('labels.company',1)}}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="company_id" required id="company" class="form-control select2-company">
                                                            <option value="{{$offer->company_id}}" selected>{{$offer->company->name}}</option>
                                                        </select>
                                                        @error('company_id')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                    <x-form.input
                                                        name="name" {{-- required --}}
                                                    type="text" {{-- optional default=text --}}
                                                        value="{{$offer->name}}"
                                                        :is-required="true" {{-- optional default=false --}}
                                                    ></x-form.input>


                                                    <x-form.input
                                                        name="price" {{-- required --}}
                                                    type="text" {{-- optional default=text --}}
                                                    value="{{$offer->price}}"
                                                        :is-required="true" {{-- optional default=false --}}
                                                    ></x-form.input>



                                                    <div id='form-container-category'>
                                                        <label for="category" >{{trans_choice('labels.category',1)}}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="category_id" required id="category" class="form-control select2-category">
                                                            <option value="{{$offer->category_id}}" selected>{{$offer->category->name}}</option>

                                                        </select>

                                                        @error('category_id')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                    <div id='form-container-country'>
                                                        <label for="country" >{{trans_choice('labels.country',3)}}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="countries[]" multiple required id="country" class="form-control select2-country">
                                                            @foreach($offer->countries as $country)
                                                                <option value="{{$country->id}}" selected>{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('countries')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                    <div id='form-container-category'>
                                                        <label for="state" >{{__('labels.state')}}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="state" required id="state" class="form-control">
                                                            <option value="1" @if((int)old('state',$offer->state) === 1) selected @endif>{{__('labels.states.1')}}</option>
                                                            <option value="2" @if((int)old('state',$offer->state) === 2) selected @endif>{{__('labels.states.2')}}</option>
                                                        </select>
                                                        @error('state')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                    <x-form.input
                                                        name="date" {{-- required --}}
                                                        type="date" {{-- optional default=text --}}
                                                        value="{{ $offer->date ? $offer->date->format('Y-m-d') : ''}}"
                                                    ></x-form.input>

                                                    <x-form.textarea
                                                        name="description" {{-- required --}}
                                                        rows="3"
                                                        value="{{$offer->description}}"
                                                    ></x-form.textarea>

                                                    <div id='form-container-featured'>
                                                        <label for="state" >{{__('labels.featured')}}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="featured" required id="featured" class="form-control">
                                                            <option value="1" @if((int)old('featured',$offer->featured) === 1) selected @endif>{{__('labels.no')}}</option>
                                                            <option value="2" @if((int)old('featured',$offer->featured) === 2) selected @endif>{{__('labels.yes')}}</option>
                                                        </select>
                                                        @error('featured')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>

                                                        <x-form.input
                                                            name="start_date" {{-- required --}}
                                                            type="date" {{-- optional default=text --}}
                                                            value="{{$offer->start_date ? $offer->start_date->format('Y-m-d') : ''}}" {{-- optional default=text --}}
                                                        ></x-form.input>

                                                        <x-form.input
                                                            name="end_date" {{-- required --}}
                                                            type="date" {{-- optional default=text --}}
                                                            value="{{$offer->end_date ? $offer->end_date->format('Y-m-d') : ''}}"
                                                        ></x-form.input>

                                                        <x-form.input
                                                            name="link" {{-- required --}}
                                                        type="text" {{-- optional default=text --}}
                                                        value="{{$offer->link}}"
                                                        ></x-form.input>

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
        $(window).on('load', function() {
            $('.select2-company').select2({
                language: {
                    noResults: function (params) {
                        return "{{__('messages.no_result')}}";
                    }
                },
                ajax: {
                    cache:true,
                    delay: 500,
                    url: '{{route('admin.companies.index')}}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };

                    },
                    processResults: function ({companies}, params) {
                        params.page = params.page || 1;

                        let fData = $.map(companies.data, function (obj) {
                            obj.text = obj.name; // replace name with the property used for the text
                            return obj;
                        });

                        return {
                            results: fData,
                            pagination: {
                                more: (params.page * 10) < companies.total
                            }
                        };
                    }
                }
            })
            $('.select2-category').select2({
                language: {
                    noResults: function (params) {
                        return "{{__('messages.no_result')}}";
                    }
                },
                ajax: {
                    cache:true,
                    delay: 500,
                    url: '{{route('admin.categories.index')}}',
                    dataType: 'json',
                    data: function (params) {
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
            $('.select2-country').select2({
                language: {
                    noResults: function (params) {
                        return "{{__('messages.no_result')}}";
                    }
                },
                ajax: {
                    cache:true,
                    delay: 500,
                    url: '{{route('admin.countries.index')}}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };

                    },
                    processResults: function ({countries}, params) {
                        params.page = params.page || 1;

                        let fData = $.map(countries.data, function (obj) {
                            obj.text = obj.name; // replace name with the property used for the text
                            return obj;
                        });

                        return {
                            results: fData,
                            pagination: {
                                more: (params.page * 10) < countries.total
                            }
                        };
                    }
                }
            })
        })


        let featured  = document.getElementById('featured');

        const updateForm = () => {
            let endDate = document.getElementById('form-container-end_date');
            let startDate = document.getElementById('form-container-start_date');
            let link = document.getElementById('form-container-link');

            if(parseInt(featured.value) === 2)
            {
                endDate.style.display = '';
                startDate.style.display = '';
                link.style.display = '';
            }else {
                endDate.style.display = 'none';
                startDate.style.display = 'none';
                link.style.display = 'none';
            }
        }

        updateForm();
        featured.addEventListener('change',function (){
            console.log(featured.checked)
            updateForm();
        })
    </script>

@endpush
