@extends('adminlte::page')

@section('title', 'Categorys')

@section('content_header')
    <h1>Categorys</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Categorys</h3>
            <a href="{{ route('categorys.create') }}" class="btn btn-success float-right">Add New Category</a>
        </div>
        <div class="card-body">
            @if ($categorys->isEmpty())
                <p>No categorys found.</p>
            @else
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorys as $category)
                            <tr>
                                <td>{{ $category->name }}</td> 
                                <td>
                                    <div style="display: flex;">
                                    <form action="{{ route('categorys.destroy', $category->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                    <form action="{{route('categorys.edit',$category->id)}}" method="GET" >
                                        <button class="btn  btn-sm " style="background: rgb(218, 242, 255)">Edit</button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
