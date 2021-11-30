@extends('layouts.app')
@section('title')
Hobbies
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Hobby details</div>

                <div class="card-body">
                    <b>{{$hobby->name}}</b>
                    <p>{{$hobby->description}}</p>
                   
                    @if($hobby->tags()->count()>0)
                    <b>Used Tags click to remove</b>
                    <div class="tags">
                        @foreach ($hobby->tags as $tag)
                       
                        <span class="badge bg-{{$tag->style}} ">
                        <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/detach">{{$tag->name}}</a>
                        </span>
                        @endforeach
                    </div>
                    @endif
                    @if($tags->count()>0)
                    <b>Available Tags click to add</b>
                    <div class="tags">
                        @foreach ($tags as $tag)                       
                        <span class="badge bg-{{$tag->style}}">
                            
                        <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/attach">{{$tag->name}}</a>
                        </span>
                        @endforeach
                    </div>
                    @endif
                    <!-- <div class="mt-2">
                        <a href='/hobby' class="btn btm-sm btn-primary"><i class="fas fa-arrow-circle-up"></i>Back to Overview</a>

                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection