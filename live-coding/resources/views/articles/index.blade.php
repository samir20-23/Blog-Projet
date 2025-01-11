@extends('adminlte::page')
@extends('layouts.app')

@section('content_header')
    <h1>Articles</h1>
@endsection

@section('content')
 
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Articles</h3>
            <a href="{{ route('articles.create') }}" class="btn btn-success float-right">Add New Article</a>
        </div>
        <div class="card-body">
            @if ($articles->isEmpty())
                <p>No articles found.</p>
            @else
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tags</th>
                            @if (Auth::user()->role == 'admin')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category->name ?? 'No Category' }}</td> <!-- Display category name -->
                                <td>{{ $article->tag->name ?? '...' }}</td> <!-- Display tag name -->
                                @if (Auth::user()->role == 'admin') 
                                <td>
                                    <div style="display: flex;">
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                                        </form>
                                        <form action="{{ route('articles.edit', $article->id) }}" method="GET" >
                                            <button class="btn btn-sm" style="background: rgb(218, 242, 255)">Edit</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

   
@endsection
