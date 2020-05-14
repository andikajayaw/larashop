@extends('layouts.global');

@section('title') Edit Category @endsection

@section('content')
    <div class="col-md-8">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <form action="{{route('categories.update', [$category->id])}}" enctype="multipart/form-data" method="POST" class="bg-white shadow-sm p-3">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <label>Category Name</label> <br>
            <input type="text" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{old('name') ? old('name') : $category->name}}" name="name">
            <div class="invalid-feedback">
                {{$errors->first('name')}}
            </div>
            <br><br>

            <label>Category Slug</label>
            <input type="text" class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}" value="{{old('slug') ? old('slug') : $category->slug}}" name="slug">
            <div class="invalid-feedback">
                {{$errors->first('slug')}}
            </div>
            <br><br>

            <label>Category Image</label> <br>
            @if($category->image)
                <span>Current Image</span> <br>
                <img src="{{asset('storage/'.$category->image)}}" alt="image" width="120px">
                <br><br>
            @endif
            <input type="file" class="form-control {{$errors->first('image') ? "is-invalid" : ""}}" name="image">
            <small class="text-muted">Kosongkan jika tidak ingin merubah gambar</small>
            <div class="invalid-feedback">
                {{$errors->first('image')}}
            </div>
            <br><br>

            <input type="submit" value="update" class="btn btn-primary">
        </form>
    </div>
@endsection