@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Sign up</h1>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => 'signup.post' !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name'), old(name), ['class' => 'form-control'] !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('passward', 'Passward') !!}
                    {!! Form::passward('passward', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('passward_confirmation', 'Confirmation) !!}
                    {!! Form::passward('passward_confirmation', [ 'class' => 'form-control'] !!}
                </div>
                
                {!! Form::submit('Sign up', [ 'class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection