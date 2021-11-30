@extends('layouts.app')
@section('title')
Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-11">
         
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2>{{auth()->user()->name}}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @isset($hobbies)
                    <h3>Your Hobbies</h3>
                    <ul class="list-group">
                        @foreach($hobbies as $hobby)
                      
     
                        <li class="list-group-item">
                            <div><a href="/hobby/{{$hobby->id}}"> {{$hobby->name}}</a></div>
                            <div class="d-none d-sm-block"> Hobbies : {{ $hobby->user->hobbies->count() }}
                      
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
                    @endisset

                    <a class="btn btn-success btn-sm" href="/hobby/create"><i class="fas fa-plus-circle"></i> Create new Hobby</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
