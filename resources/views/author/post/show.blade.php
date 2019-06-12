<?php
use Carbon\Carbon;
?>

@extends('layouts.backend.app')

@section('title', 'Post - View')

@push('css')
@endpush


@section('content')
<!-- Vertical Layout -->

    @method('PATCH')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                
            <a class="btn btn-danger waves-effect" href="{{ route('author.post.index') }}">BACK</a>
            
            @if ($post->is_approved ==  false)
                <button type="button" class="btn btn-success pull-right waves-effect">
                    <i class="material-icons">done</i>
                    <span>Approve</span>
                </button>
            @else
                <button type="button" class="btn btn-success pull-right" disabled>
                    <i class="material-icons">done</i>
                    <span>Approved</span>
                </button>
            @endif
            <br>
            <br>
            <br>
                <div class="card">
                    <div class="header">
                        <h1>{{ $post->title}}</h1>
                        <p>posted by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->toFormatteddateString() }}</p>
                        
                    </div>
                    <div class="body">
                        {!! $post->body!!}
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-blue">
                        <h2>Categories</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->categories as $postCategory)
                            <p class="badge bg-blue">{{ $postCategory->name}}</p>
                        @endforeach
                    </div>
                </div>
            
                <div class="card">
                    <div class="header bg-green">
                        <h2>Categories</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $postTag)
                            <p class="badge bg-green">{{ $postTag->name}}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-pink">
                        <h2>Feature Image</h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ url('storage/post/'.$post->image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
<!-- #END# Vertical Layout -->
@endsection

@push('js')
    

@endpush