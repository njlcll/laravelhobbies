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
                        @foreach($hobbies as $hobby)

                        <li class="list-group-item">
                            <a href="/hobby/{{$hobby->id}}">{{$hobby->name}}</a>
                            @auth
                            <a class='btn btn-small btn-light' href="/hobby/{{$hobby->id}}/edit"><i class="fas fa-edit"></i>Edit</a>
                            @endauth
                            <span class="mx-2">{{$hobby->user->name}}</span>
                            @auth
                            <form class="float-right" style="display: inline" action="/hobby/{{ $hobby->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                            </form>
                            @endauth
                            <span class='float-right mx-2'>{{$hobby->created_at->diffForHumans()}}</span>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-3">
                         {{$hobbies->links()}} 
                    </div>
                    @auth
                    <div class="mt-2">
                        <a href='hobby/create' class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i>Add Hobby</a>

                    </div>
                    @endauth
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection