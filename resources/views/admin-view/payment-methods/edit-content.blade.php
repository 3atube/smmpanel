@extends('admin-view.layouts.app')
@section('scripts')
<script>
    $(document).ready(function() {

        $('#summernote').summernote({
            placeholder: 'Please enter your content',
            tabsize: 2,
            focus: true,
            height: 450,
            codemirror: { // codemirror options
                theme: 'monokai'
            },
            callbacks: {
                // onImageUpload: function(files, editor, welEditable) {

                //     for (var i = files.length - 1; i >= 0; i--) {
                //         sendFile(files[i], this);
                //     }
                // }
            }
        });

        function sendFile(file, el) {
            var form_data = new FormData();
            var url1 = '{{route('admin.images')}}';
            form_data.append('file', file);
            $.ajax({
                data: form_data,
                type: "POST",
                url: url1,
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    var image = '/' + url;
                    $(el).summernote('editor.insertImage', url);
                }
            });
        }
    });
</script>
<style>
    @media (min-width: 768px) {
        .modal-dialog {
            width: 800px;
        }
    }

    .ui-helper-hidden-accessible {
        display: none;
    }
</style>
@endsection
@section('content')
<form class="form" action="{{route('admin.payment-methods.update', [$info->id]) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="modal-body">
        <div class="form-group">
            <label class="form-group__service-name">Method </label>
            <input class="form-control" value="{{$info->method_name}}">
        </div>
        @if($errors->has('method_name'))
        <div class="error">{{ $errors->first('method_name') }}</div>
        @endif
        <div class="form-group">
            <label class="form-group__service-name">Content </label>
            <textarea id="summernote" class="form-control" rows="10" name="method_content">{!!$info->method_content!!}</textarea>
        </div>
        @if($errors->has('method_content'))
        <div class="error">{{ $errors->first('method_content') }}</div>
        @endif
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <a type="button" class="btn btn-default" href="{{route('admin.payment-methods')}}">Close</a>
    </div>
</form>

@endsection