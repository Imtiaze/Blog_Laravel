@extends('layouts.backend.app')

@section('title', 'Post - Update')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }} " rel="stylesheet" />
@endpush


@section('content')
<!-- Vertical Layout -->
<form  method="post" action="{{ route('admin.post.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <div class="card">
                    <div class="header">
                        <h2>
                            Update Post
                        </h2>
                        
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" name="title" value="{{ $post->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Feature Image</label>
                            <input type="file" name="image" class="form-control" >
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="publish" class="filled-in" name="status" value="1" {{ $post->status == true ? 'checked': '' }}>
                            <label for="publish">Publish</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categories & Tags
                        </h2>
                        
                    </div>
                    <div class="body">
                        
                        <div class="form-group">
                            <div class="form-line  {{ $errors->has('categories') ? 'focused error':''}}">
                                <label for="category">Select Category</label>
                                <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach ($categories as $category)
                                        <option 
                                        @foreach ($post->categories as $postCategories)
                                            {{ $category->id == $postCategories->id ? 'selected':'' }}
                                        @endforeach
                                        value="{{$category->id}}"> {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error':''}}">
                                <label for="tag">Select Tag</label>
                                <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach ($tags as $tag)
                                        <option 
                                        @foreach ($post->tags as $postTags)
                                            {{ $tag->id == $postTags->id ? 'selected':'' }}
                                        @endforeach
                                        value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        
                        <br>
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.post.index') }}">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add Post body
                    </h2>
                    
                </div>
                <div class="body">
                    <textarea id="tinymce" name="body"  >{{$post->body}}</textarea>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- #END# Vertical Layout -->
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }} "></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }} "></script>

    <script type="text/javascript">
        $(function () {

            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>

@endpush