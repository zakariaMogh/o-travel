@extends('admin.layouts.app')

@section('title',trans_choice('labels.country',2))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name'=> trans_choice('labels.country',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        {{__('labels.list',['name'=> trans_choice('labels.country',2)])}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="row" id="table-head">
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <button title="{{__('actions.back')}}"
                                        onclick="document.location = '{{url()->previous()}}'" type="button"
                                        class="btn btn-icon btn-outline-info">
                                    <i data-feather='arrow-right'></i>
                                </button>
                            </div>
                            @can('create-country')
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{__('actions.create')}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <form class="form form-horizontal" method="post"
                                                  action="{{route('admin.countries.store')}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        <x-form.input
                                                            name="name" {{-- required --}}
                                                        :value="old('name')"
                                                            type="text" {{-- optional default=text --}}
                                                            :is_required="true" {{-- optional default=false --}}
                                                        />

                                                    </div>
                                                    <div class="col-12 ">
                                                        <button type="submit"
                                                                class="btn btn-primary mr-1">{{__('labels.save')}}</button>
                                                        <button type="reset" class="btn btn-outline-secondary">{{__('labels.reset')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">

                        <div class="card">

                            <div class="card-header ">
                                {{--                                                                <div>--}}
                                {{--                                                                    @can('create-county')--}}
                                {{--                                                                        <button title="{{__('actions.create')}}" data-toggle="modal" id="create-btn"--}}
                                {{--                                                                                data-target="#modals-slide-in" type="button"--}}
                                {{--                                                                                class="btn btn-icon btn-outline-primary">--}}
                                {{--                                                                            <i data-feather="plus"></i>--}}
                                {{--                                                                        </button>--}}
                                {{--                                                                    @endcan--}}
                                {{--                                                                </div>--}}


                            </div>

                            <div class="card-body">
                                <div class="card-tools">
                                    <form id="filter-form">
                                        <div class="row justify-content-end">
                                            @include('admin.layouts.partials.search')

                                            <div class="form-group mr-1 mt-2">
                                                <button type="submit"
                                                        class="btn btn-success">{{__('labels.search')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('labels.name')}}</th>
                                            <th>{{__('labels.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($countries as $key => $t)
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    {{$t->name}}
                                                </td>

                                                <td>

                                                    {{--                                                    @can('view-county')--}}
                                                    {{--                                                        <a title="{{__('actions.details')}}"--}}
                                                    {{--                                                           href="{{route('admin.countrie.show',$t->id)}}">--}}
                                                    {{--                                                            <i data-feather="eye" class="mr-50"></i>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    @endcan--}}

                                                    @can('edit-country')
                                                        <a title="{{__('actions.edit')}}"
                                                           href="{{route('admin.countries.edit',$t->id)}}">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete-country')
                                                        <a title="{{__('actions.delete')}}"
                                                           onclick="deleteForm({{$t->id}})" href="javascript:void(0);">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                        </a>
                                                    @endcan


                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center my-1">
                                        {{$countries->links()}}
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

    <script>


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
            f.setAttribute('action', `/admin/countries/${id}`);

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
    <script src="{{asset('assets/admin/app-assets/js/scripts/pages/app-user-edit.js')}}"></script>

@endpush
