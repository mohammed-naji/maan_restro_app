@extends('layouts.master')
@section('main')
    <div class="d-flex justify-content-between align-items-center mt-2">

        <h1 class="h2">Update Category</h1>

        <a class="btn btn-primary px-5" href="{{ route('categories.index') }}">Return Back</a>
    </div>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('put')

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" placeholder="Title" value="{{ $category->title }}" class="form-control" />
    </div>

    <button class="btn btn-warning">Update</button>
    </form>
@stop
