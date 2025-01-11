<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Box for Articles -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="small-box bg-info p-4 rounded shadow">
                    <div class="inner text-white">
                        <h4>Articles</h4>
                    </div>
                    <div class="icon text-white">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="{{ route('articles.index') }}" class="small-box-footer text-white d-flex justify-content-between align-items-center">
                        Plus de détails
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Box for Categories -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="small-box bg-success p-4 rounded shadow">
                    <div class="inner text-white">
                        <h4>Categories</h4>
                    </div>
                    <div class="icon text-white">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{ route('categorys.index') }}" class="small-box-footer text-white d-flex justify-content-between align-items-center">
                        Plus de détails
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Box for Tags -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="small-box bg-warning p-4 rounded shadow">
                    <div class="inner text-white">
                        <h4>Tags</h4>
                    </div>
                    <div class="icon text-white">
                        <i class="fa fa-tags"></i>
                    </div>
                    <a href="{{ route('tags.index') }}" class="small-box-footer text-white d-flex justify-content-between align-items-center">
                        Plus de détails
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Box for Comments -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="small-box bg-danger p-4 rounded shadow">
                    <div class="inner text-white">
                        <h4>Comments</h4>
                    </div>
                    <div class="icon text-white">
                        <i class="fa fa-comments"></i>
                    </div>
                    <a href="{{ route('comments.index') }}" class="small-box-footer text-white d-flex justify-content-between align-items-center">
                        Plus de détails
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
