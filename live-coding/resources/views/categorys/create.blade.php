{{-- resources/views/categorys/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Create Category')

@section('content_header')
    <h1>Create Category</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categorys.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div> 

                <button type="submit" class="btn btn-success">Save Category</button>
                <a href="{{ route('categorys.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
@endsection
