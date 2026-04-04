@extends('layouts.admin')

@section('header', app_term('categories'))

@section('content')
    <div class="card card-warning">
        <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
@stop
