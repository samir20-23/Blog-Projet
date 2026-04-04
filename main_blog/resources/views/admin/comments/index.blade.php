@extends('layouts.admin')

@section('header', app_term('categories'))

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Article</th>
                        <th>Author</th>
                        <th>Content</th>
                        <th style="width: 100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->article ? Str::limit($comment->article->title, 20) : 'None' }}</td>
                            <td>{{ $comment->user ? $comment->user->name : 'None' }}</td>
                            <td>{{ Str::limit($comment->content, 50) }}</td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection