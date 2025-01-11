@extends('adminlte::page')

@section('title', 'Comments')

@section('content_header')
    <h1>Comments</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Comments</h3> 
        </div>
        <div class="card-body">
            @if ($comments->isEmpty())
                <p>No comments found.</p>
            @else
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Article</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->user->name ?? 'No Author' }}</td> <!-- Display author name -->
                                <td>{{ $comment->article->title ?? 'No Article' }}</td> <!-- Display article title -->
                                <td>{{ $comment->content }}</td>
                                <td>
                                    <div style="display: flex;">
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
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
