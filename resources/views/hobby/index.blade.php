@extends('layouts.app')
@section('title')
Hobbies
@endsection
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <span class='float-right'>
                        @isset($filter)
                        <span class="badge bg-{{$filter->style}} ">
                   
                            Filter : {{$filter->name}}
                  
                    </span>

                    <a class='btn btn-outline-secondary btn-sm mx-1' href="/hobby"></i>All Hobbies</a>
                    @else
                    All Hobbies
                    @endisset
                    </span>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($hobbies as $hobby)
                      
     
                        <li class="list-group-item">
                            <div><a href="/hobby/{{$hobby->id}}"> {{$hobby->name}}</a></div>
                            <div class="d-none d-sm-block">By <a href="user/{{$hobby->id}}">{{$hobby->name}}</a> Hobbies : {{ $hobby->user->hobbies->count() }}
                      
                                <br> {{$hobby->created_at->diffForHumans()}}
                            </div>
                            <div class="tags">
                                @foreach ($hobby->tags as $tag)

                                <span class="badge bg-{{$tag->style}} ">
                                    <a href="/hobby/tag/{{$tag->id}}">
                                        {{$tag->name}}
                                    </a>
                                </span>
                                @endforeach
                            </div>
                            @auth
                            <a class='btn btn-outline-secondary btn-sm float-right mx-1' href="/hobby/{{$hobby->id}}/edit"><i class="fas fa-edit"></i>Edit</a>

                            <form class="float-right mx-1" style="display: inline" action="/hobby/{{ $hobby->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                            </form>
                            @endauth

                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-3 links d-flex justify-content-center ">
                        {{$hobbies->links()}}
                    </div>
                    @auth
                    <div class="mt-2">
                        <a href='/hobby/create' class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i>Add Hobby</a>

                    </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection