@extends('layouts.app')
@section('title')
Hobbies
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">All the hobbies</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($tags as $tag)

                        <li class="list-group-item">
                            <span style="font-size: 130%;" class="mr-2 badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                            @can('update', $tag)
                            <a class='btn btn-small btn-light' href="/tag/{{$tag->id}}/edit"><i class="fas fa-edit"></i>Edit</a>

                            @endcan
                            @can('delete', $tag)
                            <form class="float-right" style="display: inline" action="/tag/{{$tag->id}}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">

                            </form>
                            @endcan
                            <div class="float-right mx-2"><a href="/hobby/tag/{{ $tag->id }}">used {{$tag->hobbies->count()}} times</a> </div>

                        </li>
                        @endforeach
                    </ul>

                    @can('delete', new App\Models\Tag)
                    <div class="mt-2">
                        <a href='/tag/create' class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i>Add tag</a>
                    </div>
                    @endcan

                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection