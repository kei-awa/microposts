@if (Auth::id() != $microposts->user_id)
    @if (Auth::user()->is_favorite($micropost->id)) !!}
        {!! Form::open(['route' => ['micropost.unfavorite', $micropost->id]], 'method' => 'delete') !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else 
        {!! Form::open(['route' => ['micropost.favorite', $micropost->id]]) !!}
            {!! Form::submit('Favorite' , ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif