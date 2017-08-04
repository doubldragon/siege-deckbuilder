@extends('layouts.app')

@section('content')
<div class="container" ng-app="app" ng-controller="Controller">
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    My Decks: 
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col">
                            
                            <ul>
                                <li ng-repeat="deck in decks"><a href="#" ng-click="showDeck(deck)">[[deck.name]]</a></li>
                            </ul>
                        </div>
                        <div class="col deckDisplay">
                            Display Cards here
                        </div>
                    </div>
                </div>
            </div>      
            <!-- <div id="accordion" role="tablist" aria-multiselectable="false">
                <div class="card" >
                    <div class="card-header" role="tab" id="heading" >
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse[[deck.id]]" aria-expanded="true" aria-controls="collapseheading"> instructions </a>
                        </h5>
                    </div>
                    <div id="collapseheading" class="collapse show" role="tabpanel" aria-labeledby="heading">
                        <div class="card-block">
                            Card list goes here
                        </div>
                    </div>
                </div>
                <div class="card" ng-repeat="deck in decks">
                    <div class="card-header" role="tab" id="heading[[deck.id]]">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse[[deck.id]]" aria-expanded="false" aria-controls="collapse[[deck.id]]"> [[deck.name]] </a>
                        </h5>
                    </div>
                    <div id="collapse[[deck.name]]" class="collapse show" role="tabpanel" aria-labeledby="heading[[deck.id]]">
                        <div class="card-block">
                            [[deck.name]]
                        </div>
                    </div>
                </div>

            </div> -->
        </div>
    </div>

</div>


@endsection

