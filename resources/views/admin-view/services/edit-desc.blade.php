@extends('admin-view.layouts.app')
@section('scripts')
<script>
    $(document).ready(function() {

        $('#summernote').summernote({
            placeholder: 'Please enter your description',
            tabsize: 2,
            focus: true,
            height: 450,
            codemirror: { // codemirror options
                theme: 'monokai'
            },
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {

                    for (var i = files.length - 1; i >= 0; i--) {
                        sendFile(files[i], this);
                    }
                }
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
<form class="form" action="{{route('admin.edit-description', [$info->id])}}" method="post" data-xhr="true">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="modal-body">
        <div class="form-group">
            <label class="form-group__service-name">Description </label>
            <textarea id="summernote" class="form-control" rows="10" name="service_description">{!!$info->service_description!!}</textarea>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update description</button>
        <a type="button" class="btn btn-default" href="{{route('admin.services')}}">Close</a>
    </div>
</form>

@endsection