@extends('admin.layouts.app')

@section('title',trans_choice('labels.notification',2))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name'=> trans_choice('labels.notification',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        {{__('labels.list',['name'=> trans_choice('labels.notification',2)])}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="row" id="table-head">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <button title="{{__('actions.back')}}"
                                        onclick="document.location = '{{url()->previous()}}'" type="button"
                                        class="btn btn-icon btn-outline-info">
                                    <i data-feather='arrow-right'></i>
                                </button>
                            </div>
                            @can('create-admin-notification')
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{__('actions.create')}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <form class="form form-horizontal" method="post"
                                                  action="{{route('admin.notifications.store')}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        <x-form.input
                                                            name="title" {{-- required --}}
                                                            :value="old('title')" {{-- optional default=null --}}
                                                            type="text" {{-- optional default=text --}}
                                                            :is-required="true" {{-- optional default=false --}}
                                                        ></x-form.input>

                                                        <x-form.textarea
                                                            name="message" {{-- required --}}
                                                            type="text" {{-- optional default=text --}}
                                                            :is-required="true" {{-- optional default=false --}}
                                                            rows="3"
                                                            :value="old('message')"
                                                        > </x-form.textarea>

                                                        <x-form.select
                                                            name="receivers" {{-- required --}}
                                                            :value="old('receivers')" {{-- optional default=null --}}
                                                            :is-required="true" {{-- optional default=false --}}
                                                            :options="[
                                                             trans_choice('labels.company',2) => 1,
                                                             trans_choice('labels.user',2) => 2,
                                                             __('labels.all') => 3,
                                                             ]" {{-- optional default=[] --}}
                                                        ></x-form.select>

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
                    <div class="col-8">

                        <div class="card">

                            <div class="card-header ">
{{--                                                                <div>--}}
{{--                                                                    @can('create-tag')--}}
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
                                            <th>{{__('labels.title')}}</th>
                                            <th>{{__('labels.receivers')}}</th>
                                            <th>{{__('labels.message')}}</th>
                                            <th>{{__('labels.actions')}}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($notifications as $key => $notification)

                                            <tr>
                                                <td>
                                                    {{$notification->id}}
                                                </td>

                                                <td>
                                                    {{$notification->title}}
                                                </td>

                                                <td>
                                                    @if($notification->receivers === 1)
                                                        <span class="badge badge-info">{{trans_choice('labels.company',2)}}</span>
                                                    @elseif($notification->receivers === 2)
                                                        <span class="badge badge-success">{{trans_choice('labels.user',2)}}</span>
                                                    @else
                                                        <span class="badge badge-primary">{{__('labels.all')}}</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{$notification->message}}
                                                </td>

                                                <td>
                                                    @can('edit-admin-notification')
                                                        <a title="{{__('actions.details')}}"
                                                           href="{{route('admin.notifications.edit',$notification->id)}}">
                                                            <i data-feather="edit" class="mr-50"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete-admin-notification')
                                                        <a title="{{__('actions.delete')}}" onclick="deleteForm({{$notification->id}})"
                                                           href="javascript:void(0)">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                        </a>
                                                    @endcan

                                                    @can('create-admin-notification')
                                                        <a title="{{__('home.send')}}" onclick="sendNotification({{$notification->id}})"
                                                           href="javascript:void(0)">
                                                            <i data-feather="bell" class="mr-50"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center my-1">
                                        {{$notifications->links()}}
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
        const sendNotification = id => {
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
                    let f = document.createElement("form");
                    f.setAttribute('method',"post");
                    f.setAttribute('action',`/admin/notifications/${id}/send`);

                    let i1 = document.createElement("input"); //input element, text
                    i1.setAttribute('type',"hidden");
                    i1.setAttribute('name','_token');
                    i1.setAttribute('value','{{csrf_token()}}');

                    f.appendChild(i1);
                    document.body.appendChild(f);
                    f.submit();
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
            f.setAttribute('action', `/admin/notifications/${id}`);

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
