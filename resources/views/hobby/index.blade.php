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
                            <a class='btn btn-small btn-light' href="/hobby/{{$hobby->id}}/edit"><i class="fas fa-edit"></i>Edit</a>
                            <form class="float-right" style="display: inline" action="/hobby/{{ $hobby->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-2">
                        <a href='hobby/create' class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i>Add Hobby</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection