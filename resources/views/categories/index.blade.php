@extends('layouts.master')
@section('main')
    <div class="d-flex justify-content-between align-items-center mt-2">

        <h1 class="h2">Categories Page</h1>

        <a class="btn btn-primary px-5" href="{{ route('categories.create') }}"><i class="fas fa-add"></i> Create New</a>
    </div>


    <table class="table table-bordered mt-4">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>

        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->created_at->diffForHumans() }}</td>
                <td>{{ $category->updated_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Are You Sure ي اخونا')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach


    </table>
@stop
