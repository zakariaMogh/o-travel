@push('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.css')}}">
@endpush

<div class="tile">
    <form action="{{ route('admin.setting.update') }}" method="POST" role="form">
        @csrf
        <h3 class="">{{__('labels.terms_of_use')}}</h3>
        <hr>
        <div class="">
            <div class="form-group">
                <textarea name="terms_of_use" id="terms_of_use"
                          cols="30"
                          rows="10"
                          class="form-control @error('terms_of_use') is-invalid @enderror"
                >{{old('terms_of_use', settings('terms_of_use'))}}</textarea>
                @error('terms_of_use')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{__('labels.save')}}</button>
                </div>
            </div>
        </div>
    </form>

</div>

@push('js')
    <!-- Summernote -->
    <script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <!-- Page specific script -->
    <script>

        // Summernote

        $('#terms_of_use').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['forecolor']],
                ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                // ['insert', ['link']],
                ['view', ['codeview']],
            ]
        })


    </script>
@endpush
