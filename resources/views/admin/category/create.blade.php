@extends('layouts.backend.app')

@section('title', 'Category - Create')


@section('content')
<!-- Vertical Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Add Category
                </h2>
                
            </div>
            <div class="body">
                <form  method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text"  name="category" class="form-control" placeholder="Enter a Tag name">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file"  name="image" class="form-control" >
                    </div>
                    
                    <br>
                    <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">BACK</a>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">INSERT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Vertical Layout -->
@endsection