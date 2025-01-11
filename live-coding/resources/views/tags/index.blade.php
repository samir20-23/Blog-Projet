@extends('adminlte::page')

@section('title', 'Tags')

@section('content_header')
    <h1>Tags</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Tags</h3>
            <a href="{{ route('tags.create') }}" class="btn btn-success float-right">Add New Tags</a>
        </div>
        <div class="card-body">
            @if ($tags->isEmpty())
                <p>No tags found.</p>
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
                        @foreach ($tags as $tags)
                            <tr>
                                <td>{{ $tags->name }}</td> 
                                <td>
                                    <div style="display: flex;">
                                    <form action="{{ route('tags.destroy', $tags->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this tags?')">Delete</button>
                                    </form>
                                    <form action="{{route('tags.edit',$tags->id)}}" method="GET" >
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
