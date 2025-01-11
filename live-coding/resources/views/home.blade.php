<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Tables</h3>
            {{-- <a href="{{ route('tables.create') }}" class="btn btn-success float-right">Add New tables</a> --}}
        </div>
        <div class="card-body">
            
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>articles</th>
                            <th>Categorys</th>
                            <th>tags</th>
                            <th>comments</th>
                        </tr>
                    </thead>
                    <tbody> 
                            <tr> 
                                <td>
                                    <div style="display: flex;">   
                                        <a  href="{{ route('articles.index') }}" class="btn btn-danger btn-sm" style="width:100%; height:90px;">Articles</a>
                                </div>
                                </td>
                                <td>
                                    <div style="display: flex;">   
                                        <a  href="{{ route('categorys.index') }}" class="btn btn-danger btn-sm" style="width:100%; height:90px;">categorys</a>
                                </div>
                                </td>
                                 <td>
                                    <div style="display: flex;">   
                                        <a  href="{{ route('tags.index') }}" class="btn btn-danger btn-sm" style="width:100%; height:90px;">tags</a>
                                </div>
                                </td>
                               <td>
                                    <div style="display: flex;">   
                                        <a  href="{{ route('comments.index') }}" class="btn btn-danger btn-sm" style="width:100%; height:90px;">comments</a>
                                </div>
                                </td>
                            </tr>  
                    </tbody>
                </table>

        </div>
    </div>
@endsection
