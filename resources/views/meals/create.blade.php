@extends('layouts.master')
@section('main')
    <div class="d-flex justify-content-between align-items-center mt-2">

        <h1 class="h2">New Meal</h1>

        <a class="btn btn-primary px-5" href="{{ route('meals.index') }}">Return Back</a>
    </div>
    <form action="{{ route('meals.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" />
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="text" name="price" placeholder="Price" class="form-control" />
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <option selected disabled>Choose Category..</option>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}">{{ $c->title }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Save</button>
    </form>
@stop
