@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Siege!</div>

                <div class="panel-body">
                    <a href="{{url ('/deckbuilder') }}">Let's Build a Deck</a>
                    @if (Auth::User()->isAdmin)
                        <p> You are an admin!</p>
                    @else
                        <p> You are definitely not an admin!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
