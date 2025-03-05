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
<form class="form" action="{{!empty($info) ? route('admin.notifications.update', [$info->id]) : route('admin.notifications.add') }}" method="post">
    @csrf
    @if(!empty($info))
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="modal-body">
        <div class="form-group">
            <label class="form-group__service-name">Title </label>
            <input class="form-control" name="title" value="{{!empty($info) ? $info->title : old('title')}}">
        </div>
        @if($errors->has('title'))
        <div class="error">{{ $errors->first('title') }}</div>
        @endif
        <div class="form-group">
            <label class="form-group__service-name">Type </label>
            <select class="form-control" name="type">
                @php $arr = ['text-success' => 'Text Success', 'text-warning'=> 'Text Warning','text-danger' => 'Text Danger'] @endphp
                @foreach($arr as $key => $value)
                <option value="{{$key}}" {{@$info->type==$key ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-group__service-name">Status </label>
            @php $arr = ['active' => 'Active', 'deactive' => 'Deactive'] @endphp
            <select class="form-control" name="status">
                @foreach($arr as $key => $value)
                <option value="{{$key}}" {{@$info->status==$key ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-group__service-name">Content </label>
            <textarea id="summernote" class="form-control" rows="10" name="content">{!!!empty($info) ? $info->content : old('content')!!}</textarea>
        </div>
        @if($errors->has('content'))
        <div class="error">{{ $errors->first('content') }}</div>
        @endif
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{!empty($info) ? 'Update' : 'Add'}}</button>
        <a type="button" class="btn btn-default" href="{{route('admin.notifications')}}">Close</a>
    </div>
</form>

@endsection