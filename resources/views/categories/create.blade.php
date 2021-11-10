@extends('layouts.master')
@section('main')
    <div class="d-flex justify-content-between align-items-center mt-2">

        <h1 class="h2">New Category</h1>

        <a class="btn btn-primary px-5" href="{{ route('categories.index') }}">Return Back</a>
    </div>
    <form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" placeholder="Title" class="form-control" />
    </div>

    <button class="btn btn-success">Save</button>
    </form>
@stop
