@extends('layouts.app')

@section('content')
<div class="container" ng-app="app" ng-controller="Controller">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" ><h4 style="display: inline-block;">Welcome to Siege!</h4>
                    @if (Auth::User()->isAdmin)
                         - Admin user
                    
                    @endif
                </div>

                <div class="panel-body ml-4">

                    <h5>Welcome back, {{Auth::User()->username}}!</h5>
                    <ul>
                        <li>
                            <a href="{{url ('/deckbuilder') }}">Build a new deck</a>
                        </li>
                        <li>
                            <a href="#" ng-click="activeSel='myDecks'">View My Decks</a>
                        </li>
                        <li>
                            <a href="#" ng-click="activeSel='recent'">View Recent Decks</a>
                        </li>
                    </ul>
                    


            
            </div>
            <div ng-show="activeSel=='myDecks'" class="panel panel-default">
                <div class="panel-heading">
                    My Decks: 
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col">
                            <table class="table-condensed">
                                <tr ng-repeat="deck in decks" ng-click="previewDeck(deck)">
                                    <td > 
                                        <a href="#" ng-click="previewDeck(deck)">[[deck.name]]</a> <br />
                                        [[deck.leader.name]]
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col deckDisplay">
                            <div ng-show="preLeader" class="row ">
                                <span class="pull-right">
                                    <form class="form-inline" method="post" action="[[editAction]]">
                                        {{method_field('GET')}}
                                        <button class='btn btn-sm btn-outline-primary ' type="submit" >Edit</button>
                                    </form>
                                </span>
                                <span class="pull-right">
                                    <form class="form-inline" method="post" action="[[deleteAction]]">
                                        {{method_field('DELETE')}}
                                        <button class='btn btn-sm btn-outline-danger ' type="submit" >Delete</button>
                                    </form>
                                </span>
                            </div>
                            <h4 class="mt-2 mb-2" ng-show="preLeader">[[preLeader]] - [[preFaction]]</h4>
                            <!-- <h5 ng-show="preLeader" class="mb-4">[[deckPoints]]/[[maxPoints]] points</h5> -->
                            <ul>
                                <li ng-repeat="card in previewCards" ng-show="card.selected" >[[card.quantity]]x [[card.name]]</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>  
            <div ng-show="activeSel=='recent'" class="panel panel-default">
                <div class="panel-heading">
                    Recent Decks: 
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col">
                            <table class="table-condensed">
                                <tr ng-repeat="deck in allDecks" ng-click="previewDeck(deck)">
                                    <td > 
                                        <a href="#" ng-click="previewDeck(deck)">[[deck.name]] - [[deck.leader.name]]</a> <br />
                                        by [[deck.username]]
                                    </td>
                                    
                                </tr>
                                <!-- <tr>
                                    <td>
                                        by [[deck.username]]
                                    </td>
                                </tr> -->
                            </table>
                        </div>
                        <div class="col deckDisplay">
                            
                            <h4 class="mt-4 mb-2" ng-show="preLeader">[[preLeader]] - [[preFaction]]</h4>
                            <!-- <h5 ng-show="preLeader" class="mb-4">[[deckPoints]]/[[maxPoints]] points</h5> -->
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

