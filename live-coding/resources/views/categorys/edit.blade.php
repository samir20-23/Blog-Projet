{{-- resources/views/categorys/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content_header')
    <h1>Edit Category</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Make sure to use PUT or PATCH method for updating -->
            <form action="{{ route('categorys.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This adds the correct HTTP method -->

                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" id="name" class="form-control" required>
                </div>
                  

                <button type="submit" class="btn btn-success">Update Category</button>
                <a href="{{ route('categorys.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
 