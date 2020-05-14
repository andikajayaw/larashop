@extends('layouts.global')

@section('title') Show Category @endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <label><b>Category Name</b></label> <br>
                {{$category->name}}
                <br><br>

                <label><b>Category Slug</b></label> <br>
                {{$category->slug}}
                <br><br>

                <label><b>Category Image</b></label> <br>
                @if($category->image)
                    <img src="{{asset('storage/'.$category->image)}}" alt="image" width="120px">
                @endif
            </div>
        </div>
    </div>
@endsection