@extends('layouts.backend.app')

@section('title', 'Category - Edit')


@section('content')
<!-- Vertical Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Update Category
                </h2>
                
            </div>
            <div class="body">
                <form  method="post" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH') 
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text"  name="name" value="{{ $category->name }}" class="form-control" placeholder="Enter a Tag name">
                        </div>
                    </div>
                    <div class="form-group">
                        
                            <input type="file"  name="image" class="form-control" >
                    </div>
                    
                    <br>
                    <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">BACK</a>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Vertical Layout -->
@endsection