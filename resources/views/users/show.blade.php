@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="card">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $users->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravader::src($user->email, 500) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="#" class="nav-link">Timeline</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Followings</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Followers</a></li>
            </ul>
        </div>
    </div>  