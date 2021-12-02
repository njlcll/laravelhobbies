@extends('layouts.app')
@section('title')
Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2>{{auth()->user()->name}}</h2>

                    <p>{{ auth()->user()->motto ?? '' }}</p>


                    <p>{{ auth()->user()->about_me ?? '' }}</p>
                    <p>
                        <a class="btn btn-primary" href="user/{{ auth()->user()->id }}/edit">Edit my profile</a>
                    </p>
                    <!-- @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif -->
                    @isset($hobbies)
                    <h3>Your Hobbies</h3>
                    <ul class="list-group">
                        @foreach($hobbies as $hobby)
                        <li class="list-group-item">
                            
                         
                            </a>
                            @if(file_exists('img/hobbies/' . $hobby->id . '_thumb.jpg'))
                            <a title="Show Details" href="/hobby/{{ $hobby->id }}">
                                <img src="/img/hobbies/{{ $hobby->id }}_thumb.jpg" alt="Hobby Thumb">
                            </a>
                            @endif
                            &nbsp;<a title="Show Details" href="/hobby/{{ $hobby->id }}">{{ $hobby->name }}</a>
                            @auth
                            <a class="btn btn-sm btn-light ml-2" href="/hobby/{{ $hobby->id }}/edit"><i class="fas fa-edit"></i> Edit Hobby</a>
                            @endauth
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

        <div class="col-md-3">
            @if(file_exists('img/users/' . auth()->user()->id .'_large.jpg'))
            <img class="img-thumbnail" src="/img/users/{{ auth()->user()->id }}_large.jpg" alt="{{ auth()->user()->name }}">
            @endif


        </div>
    </div>
</div>
@endsection