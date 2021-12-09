@extends('layouts.app')
@section('title')
Laravel Demo 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <h4>Info</h4>
            <div class="card">
                <div class="card-header">Laravel Hobby Membership Demo</div>

                <div class="card-body">
                <h4> This is a demo site written in Laravel 8.</h4>
                  <p>
                    <ul class="list-group  list-group-flush">
                        <li class="list-group-item">
                            Laravel Blade Templating and U.I scaffolding
                        </li>
                        <li class="list-group-item">
                            Laravel Blade Templating and U.I scaffolding
                        </li>
                        <li class="list-group-item">
                            CRUD, Resourses and Models and Eloquent model relationships.
                        </li>
                        <li class="list-group-item">
                            CRUD, Resourses and Models
                        </li>
                        <li class="list-group-item">
                           Database migrations factories and seeders
                        </li>
                        <li class="list-group-item">
                          Image Upload and manipulation using the Intervention  package
                        </li>
                        <li class="list-group-item">
                          User auth useing middeware policies and gates
                        </li>
                    </ul> 
                    </ul> 
                  </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
