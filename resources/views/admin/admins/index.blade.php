@extends('admin.layouts.app')

@section('title',trans_choice('labels.admin',2))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name'=> trans_choice('labels.admin',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        {{__('labels.list',['name'=> trans_choice('labels.admin',2)])}}
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
                                    @can('create-admin')
                                        <a title="{{__('actions.create')}}" href="{{route('admin.admins.create')}}"
                                                class="btn btn-icon btn-outline-primary">
                                            <i data-feather="plus"></i>
                                        </a>
                                    @endcan
                                </div>
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
                                            <th>{{trans_choice('labels.image', 1)}}</th>
                                            <th>{{__('labels.name')}}</th>
                                            <th>{{__('labels.email')}}</th>
                                            <th>{{trans_choice('labels.role',1)}}</th>
                                            <th>{{__('actions.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($admins as $key => $admin)
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    <span class="avatar">
                                                          <img src="{{$admin->image_url}}" class="round" height="50" width="50" alt="{{$admin->name}} logo" />
                                                    </span>
                                                </td>
                                                <td>
                                                    {{$admin->name}}
                                                </td>
                                                <td>
                                                    <a href="mailto:{{$admin->email}}" class="text-decoration-none">{{$admin->email}}</a>

                                                </td>
                                                <td>
                                                    @foreach($admin->roles as $role)
                                                        <span class="badge badge-success">
                                                            {{$role->name}}
                                                         </span>
                                                    @endforeach
                                                </td>
                                                <td>

                                                    @can('view-admin')
                                                        <a title="{{__('actions.details')}}"
                                                           href="{{route('admin.admins.show',$admin->id)}}">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                        </a>
                                                    @endcan

                                                    @can('edit-admin')

                                                        <a title="{{__('actions.edit')}}"
                                                           href="{{route('admin.admins.edit',$admin->id)}}">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                        </a>

                                                        <a title="{{__('actions.update-password')}}"
                                                           href="{{route('admin.admins.edit-password',$admin->id)}}">
                                                            <i data-feather="lock" class="mr-50"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete-admin')
                                                        <a title="{{__('actions.delete')}}"
                                                           onclick="deleteForm({{$admin->id}})" href="javascript:void(0);">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                        </a>
                                                    @endcan


                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center my-1">
                                        {{$admins->links()}}
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
            f.setAttribute('action', `/admin/admins/${id}`);

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
