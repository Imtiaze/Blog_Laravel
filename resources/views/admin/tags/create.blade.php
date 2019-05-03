@extends('layouts.backend.app')

@section('title', 'Tag - Create')


@section('content')
<!-- Vertical Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Add Tag
                </h2>
                
            </div>
            <div class="body">
                <form  method="post" action="{{ route('admin.tag.store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text"  name="tag" class="form-control" placeholder="Enter a Tag name">
                        </div>
                    </div>
                    
                    <br>
                    <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tag.index') }}">BACK</a>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">INSERT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Vertical Layout -->
@endsection