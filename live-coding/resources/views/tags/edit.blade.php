{{-- resources/views/tags/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Tags')

@section('content_header')
    <h1>Edit Tags</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Make sure to use PUT or PATCH method for updating -->
            <form action="{{ route('tags.update', $tags->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This adds the correct HTTP method -->

                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" value="{{ old('name', $tags->name) }}" id="name" class="form-control" required>
                </div>
                  

                <button type="submit" class="btn btn-success">Update Tags</button>
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
 