<div class="table-responsive">
    <table class="table">
        <thead class="thead-light">
        <tr>
            @foreach($headers as $header)
                <th>{{__('labels.'.$header)}}</th>
            @endforeach
            @if( $delete or $show or $edit)
                <th>{{__('labels.actions')}}</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @forelse($objects as $key => $object)
            <tr>
                @foreach($headers as $key => $value)
                    <td>{{$object[$key]}}</td>
                @endforeach
                {{--                {{route('admin.units.edit',$u->id)}}--}}
                {{--                {{$u->id}}--}}
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            @if($show)
                                {{--                    --}}
                                {{--                    @can('view-'.$permission)--}}
                                <a class="dropdown-item" title="{{__('actions.details')}}" href="{{route('admin.'.$name.'.show', $object['id'])}}">
                                    <i data-feather="eye" class="mr-50"></i>
                                </a>
                                {{--                    @endcan--}}

                            @endif
                                @if($edit)
                                    {{--                    @can('edit-'.$permission)--}}
                                    <a href=""
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="dropdown-item" title="{{__('actions.edit')}}" href="{{route('admin.'.$name.'.edit', $object['id'])}}">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                    </a>
                                    {{--                    @endcan--}}
                                @endif
                                @if($delete)
                                    {{--                    @can('delete-'.$permission)--}}

                                    <a class="dropdown-item" title="{{__('actions.delete')}}" onclick="deleteForm({{$object->id}})" href="javascript:void(0);">
                                        <i data-feather="trash" class="mr-50"></i>
                                    </a>
                                    {{--                    @endcan--}}
                                @endif
                        </div>
                    </div>
                </td>
            </tr>
        @empty
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-1">
{{--        {{$objects->links()}}--}}
    </div>
</div>


@push('js')
    <script>
        const deleteItem = id => {

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
            f.setAttribute('action', `/admin/{{$name}}/${id}`);

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
