@extends('admin.layouts.app')

@section('title',trans_choice('labels.offer',2))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name'=> trans_choice('labels.offer',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        {{__('labels.list',['name'=> trans_choice('labels.offer',2)])}}
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

                            <div class="card-header ">
                                <div>
                                    @can('create-offer')
                                        <a title="{{__('actions.create')}}"  id="create-btn"
                                                class="btn btn-icon btn-outline-primary" href="{{route('admin.offers.create')}}">
                                            <i data-feather="plus"></i>
                                        </a>
                                    @endcan
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="card-tools">
                                    <form id="filter-form">
                                        <div class="row justify-content-end">
                                            <div class="form-group col-md-1">
                                                <label for="state">{{__('labels.state')}}</label>
                                                <select name="state" id="state" class="form-control">
                                                    <option value=""> {{__('labels.all')}}</option>
                                                    <option value="1" {{request('state') == 1 ? 'selected' : ''}}> {{__('labels.active')}}</option>
                                                    <option value="2" {{request('state') == 2 ? 'selected' : ''}}> {{__('labels.inactive')}}</option>
                                                </select>
                                            </div>

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
                                            <th>{{__('labels.name')}}</th>
                                            <th>{{__('labels.date')}}</th>
{{--                                            <th>{{__('labels.wallet')}}</th>--}}
                                            <th>{{__('labels.price')}}</th>
                                            <th>{{trans_choice('labels.company',1)}}</th>
                                            <th>{{trans_choice('labels.category',1)}}</th>
                                            <th>{{__('labels.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($offers as $offer)
                                            <tr>
                                                <td>
                                                    {{$offer->name}}
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{$offer->date->format('m/d/2021')}}</span>
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
                                                    <span class="badge badge-success">
                                                        {{$offer->category->name}}
                                                    </span>
                                                </td>
                                                <td>

                                                    @can('view-offer')
                                                        <a title="{{__('actions.details')}}"
                                                           href="{{route('admin.offers.show',$u->id)}}">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                        </a>
                                                    @endcan

                                                    @can('edit-offer')
                                                        <a title="{{__('actions.edit')}}"
                                                           href="{{route('admin.offers.edit',$u->id)}}">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                        </a>
                                                    @endcan


                                                    @can('delete-offer')
                                                        <a title="{{__('actions.delete')}}"
                                                           onclick="deleteForm({{$u->id}})" href="javascript:void(0);">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                        </a>
                                                    @endcan




                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center my-1">
                                        {{$offers->links()}}
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
            f.setAttribute('action', `/admin/offers/${id}`);

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
