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
                            <table class="table-condensed">
                                <tr ng-repeat="deck in decks" ng-click="previewDeck(deck)">
                                    <td > 
                                        <a href="#" ng-click="previewDeck(deck)">[[deck.name]]</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col deckDisplay">
                            <div ng-show="preLeader" class="mb-4">
                                <span class="pull-right">
                                <form class="form-inline" method="post" action="[[editAction]]">
                                    {{method_field('GET')}}
                                    <button class='btn btn-sm btn-outline-primary ' type="submit" >Edit</button>
                                </form>
                                <form class="form-inline" method="post" action="[[deleteAction]]">
                                    {{method_field('DELETE')}}
                                    <button class='btn btn-sm btn-outline-danger ' type="submit" >Delete</button>
                                </form>
                                </span>
                            </div>
                            <h4 ng-show="preLeader">[[preLeader]] - [[preFaction]]</h4>
                            <ul>
                                <li ng-repeat="card in previewCards" ng-show="card.selected" >[[card.quantity]]x [[card.name]]</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div>

</div>


@endsection

