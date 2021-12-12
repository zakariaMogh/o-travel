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
                            <h2 class="content-header-title float-left mb-0">{{__('actions.edit')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
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
                            <div class="card-header d-flex justify-content-start">
                                <button title="{{__('actions.back')}}" onclick="document.location = '{{url()->previous()}}'" type="button" class="btn btn-icon btn-outline-info">
                                    <i data-feather='arrow-right'></i>
                                </button>

                                @can('create-admin-notification')
                                    <button title="{{__('home.send')}}" onclick="sendNotification({{$notification->id}})" type="button" class="btn btn-icon btn-outline-success mx-1">
                                        <i data-feather='bell'></i>
                                    </button>
                                @endcan

                            </div>
                            <div class="col-md-6 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{__('actions.edit')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form form-horizontal" method="post" action="{{route('admin.notifications.update', $notification->id)}}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <x-form.input
                                                        name="title" {{-- required --}}
                                                    :value="old('title',$notification->title)" {{-- optional default=null --}}
                                                        type="text" {{-- optional default=text --}}
                                                        :is-required="true" {{-- optional default=false --}}
                                                    ></x-form.input>

                                                    <x-form.textarea
                                                        name="message" {{-- required --}}
                                                    type="text" {{-- optional default=text --}}
                                                        :is-required="true" {{-- optional default=false --}}
                                                        rows="3"
                                                        :value="old('message',$notification->message)"
                                                    > </x-form.textarea>

                                                    <x-form.select
                                                        name="receivers" {{-- required --}}
                                                        :value="old('receivers',$notification->receivers)" {{-- optional default=null --}}
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
    </script>

@endpush
