@extends('layouts.global')

@section('title') Books List @endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('books.index')}}">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control" placeholder="Filter by title">
                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a href="{{route('books.index')}}" class="nav-link">All</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('books.index', ['status' => 'publish'])}}" class="nav-link">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('books.index', ['status' => 'draft'])}}" class="nav-link">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('books.trash')}}" class="nav-link">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-3">
            
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{route('books.create')}}" class="btn btn-primary">Create Book</a>
                </div>
            </div>

            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th><b>Cover</b></th>
                        <th><b>Title</b></th>
                        <th><b>Author</b></th>
                        <th><b>Status</b></th>
                        <th><b>Categories</b></th>
                        <th><b>Stock</b></th>
                        <th><b>Price</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>
                                @if($book->cover)
                                    <img src="{{asset('storage/'.$book->cover)}}" alt="cover-image" width="96px">
                                @endif
                            </td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>
                                @if($book->status === "DRAFT")
                                    <span class="badge bg-dark text-white">{{$book->status}}</span>
                                @else
                                    <span class="badge badge-success">{{$book->status}}</span>
                                @endif
                            </td>
                            <td>
                                <ul class="pl-3">
                                    @foreach($book->categories as $category)
                                        <li>{{$category->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{$book->stock}}</td>
                            <td>{{$book->price}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{route('books.edit', [$book->id])}}">Edit</a>
                                
                                <form action="{{route('books.destroy', [$book->id])}}" class="d-inline" method="POST" onsubmit="return confirm('Move book to trash?')">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colSpan="10">
                            {{$books->appends(Request::all())->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection