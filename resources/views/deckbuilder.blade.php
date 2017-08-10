@extends ('layouts.app')


@section('content')

	<div class='container text-center' ng-app="app" ng-controller="Controller">
		<h1 class="banner">Siege! Deckbuilder</h1>
		
<div ng-hide="selectLead" class="">
	<div ng-hide="newExisting" >
		<button class="btn btn-success mt-3" ng-click="newExisting=true;">Create New Deck</button>
		<p class="mb-1">or Select Existing Deck to Edit</p>
		<form class='form-inline text-center'>
			<div class="form-group" style='margin: 0 auto;'>
		    	
			    <select class="form-control mb-4" id="deckSelect" name="deckSelect">
			      <option name='' value=''>Choose Deck</option>
			      <option name='deckSelect' ng-repeat="deck in decks" value="[[deck]]">[[deck.name]]</option>
			    </select>
				<button style="margin: 0 auto;" class='btn btn-success mb-4' type="submit" ng-click='openDeck()'>Select Deck</button>
			</div>
		</form>
	</div>
		<div ng-show="newExisting" class='form-group'>	
				<div class="container" >
				<button class="btn btn-success mr-1 ml-1 mb-4 mt-2" ng-click="isMonarch=true; selectFaction=true;">Monarch</button>
				<button class="btn btn-success mr-1 ml-1 mb-4 mt-2" ng-click="isMonarch=false; selectFaction=true;">Invader</button>
				</div>
				<p ng-hide="selectFaction"><strong>Select your faction</strong></p>
				<p ng-show="selectFaction"><strong>Who will lead you into battle?</strong></p>
				<div ng-show="selectFaction"  style="display: inline-block;" class="row">
				<div class="col col-md-8 ">
					<div class=" row" style="width:500px;">
					<div ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {type_id: 1}" class="w-100 mx-auto ml-1 mr-1 panel panel-default" style="padding-left: 0;padding-right: 0;">
					 	<div  class="panel-heading text-center" style="width:100%;">
							<strong><h3 style="margin:0;display:inline-block;">[[card.name]]</h3></strong>
							<span class="pull-right">
								<button style="margin-top:-3px" ng-class="{'btn-success': [[isMonarch]], 'btn-danger': ![[isMonarch]]}" class="btn mr-1 ml-1 " ng-click="revealCards(card)">Select</button>
							</span>
					 	</div>
					 	<div class="row panel-body w-100 ml-3">
					 		<div class="mt-2 col-sm-4" style="padding-right:0;padding-left: 0;">
					 			<img src='[[card.type_icon]]' height="120px" width="120px" >
					 		</div>
					 		<div class="col-sm-8">
					 			<div class="row">
					 				<p style="color:#000;text-align: left;"><strong>Action: </strong>[[card.action]]</p>
					 			</div>
					 			<div class="row">
					 				<p style="color:#000;text-align: left;"><strong>Effect: </strong>[[card.effect]]</p>
					 			</div>
					 			<div class="row" style="text-align: left; position:absolute; bottom:0;">
						 			<strong>5</strong> <img src="https://png.icons8.com/coins-filled/ios7/25" title="Coins Filled" width="15" height="15"> 
						 			<strong> &nbsp &nbsp 5</strong> <img src="https://png.icons8.com/ruby-gemstone-filled/ios7/25" title="Coins Filled" width="15" height="15">
								</div>
					 		</div>
					 	</div>
					 	<div class="panel-footer text-center" style="padding:5px;">
							<small>[[card.flavor_text]]</small>
					 	</div>
					</div>
					</div>
				</div>
			
			</div>
		</div>
</div>		

		<div ng-show="selectLead">
			
				
			<div class='row'>
				<div class='col col-md-6' id='myDeck'>
					<div class='row mb-3'>
				<div class='col'>
					<form method='post' action="/api/decks" ng-hide="isEdit" style="display:inline-block;"> 
						{{ method_field('POST')}}
						<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
						<input type="hidden" name="userDeck" value="[[cards]]">
						<input type="hidden" name="lead_id" value="[[leader.id]]">
						<input type="hidden" name="isMonarch" value="[[leader.isMonarch]]">
						<input class="searchBar" type="text" name="name" ng-model="deckName"  placeholder="Name Your Deck">
						<button class='btn btn-success' value="submit"  name='saveDeck' ng-disabled="deckPoints>maxPoints">Save Deck</button>
					</form>
					<form method='post' action="[[editAction]]" ng-show="isEdit" style="display:inline-block;"> 
						{{ method_field('PUT')}}
						<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
						<input type="hidden" name="deck_id" value="[[deck_id]]">
						<input type="hidden" name="userDeck" value="[[cards]]">
						<input type="hidden" name="lead_id" value="[[leader.id]]">
						<input type="hidden" name="isMonarch" value="[[leader.isMonarch]]">
						<input class="searchbBar" type="text" name="name" ng-model="deckName" placeholder="Name Your Deck">
						<button class='btn btn-success' value="submit"  name='saveDeck' ng-disabled="deckPoints>maxPoints">Save Edit</button>
					</form>
				</div>
			</div>
			<div class="panel panel-default deckHeader">
        		<div class="panel-heading " >
        			<h4 style="display:inline-block"><strong>[[leader.name]]</strong></h4> - 
					<h5 style="display:inline-block"> [[leader.flavor_text]]</h5> <br />
					<h5 class = "mt-1" ng-class="{'error': deckPoints > maxPoints}">Deck Points: [[deckPoints]]/[[maxPoints]]</h5>
    			</div>

        		<div class="panel-body">
                   	<div class="row">
                   		<div class= "col col-sm-4">
                   			<img src='[[leader.type_icon]]' class="ml-2">
                   		</div>
                   		<div class="col col-sm-8">
                   			<div class="row">[[leader.action]]</div>
                   			<div class="row">[[leader.effect]]</div>
                   		</div>
                   	</div> 
            	</div>
		 	</div>
			<table class="table table-hover">
				<tr>
					<th class>Qty</th>
					<th>Name</th>
					<th>Points</th>
					<th>Action</th>
				</tr>
				<tr ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {display: true} | filter: {selected: true}">
					@include ('tablerow')
				</tr>

			</table>
		</div>
		<div class='col' id='availableCards'>
			<button class="btn btn-warning mb-3" ng-click="resetForm()">Reset Builder</button>
			<div class="panel panel-default deckHeader">
        		<div class="panel-heading " >
        			<h4 style="display:inline-block">Available Cards</h4>
    			</div>

        		<div class="panel-body">
                   	<div class="row">
                   		<div class="col col-sm-6">
                   			<input class="searchBar" id="searchBar" type="text" placeholder="Search for card..." ng-model="searchText">
                   		</div>
                   		<div class="col col-sm-6">
                   			<div class="btn-group" >
							  <label class="btn btn-default" ng-class="{'active': displayFilter['food']}">
							    <input type="checkbox" ng-click="typeFilter('food')"> 
							    <img src="https://png.icons8.com/poultry-leg-filled/ios7/25" title="Food" width="20" height="20">
							  </label>
							  <label class="btn btn-default" ng-class="{'active': displayFilter['morale']}">
							    <input type="checkbox" ng-click="typeFilter('morale')"> 
							    <img src="https://png.icons8.com/happy/ios7/25" title="Morale" width="20" height="20"> 
							  </label>
							  <label class="btn btn-default" ng-class="{'active': displayFilter['engine']}">
							    <input type="checkbox" ng-click="typeFilter('engine')">
							    <img src="https://png.icons8.com/catapult/ios7/25" title="Siege Engines" width="20" height="20">
							  </label>
							  <label class="btn btn-default" ng-class="{'active': displayFilter['defense']}">
							    <input type="checkbox" ng-click="typeFilter('defense')">
							    <img src="https://png.icons8.com/defense/androidL/24" title="Defense" width="20" height="20"> 
							  </label>
							  <label class="btn btn-default" ng-class="{'active': displayFilter['spy']}">
							    <input type="checkbox" ng-click="typeFilter('spy')">
							    <img src="https://png.icons8.com/spy-male-filled/ios7/25" title="Espionage" width="20" height="20">
							  </label>
							</div>
                   		</div>
                   	</div> 
            	</div>

            
		 	</div>
					
			<table class="table table-hover">
				<tr>
					<th class>Qty</th>
					<th>Name</th>
					<th>Points</th>
					<th>Action</th>
				</tr>
				<tr ng-repeat="card in cards  | filter: {isMonarch: isMonarch} | filter: {display: true} | filter: searchText " ng-show="toggleFilter(card.type_id)">
				<!-- | filter: {selected: false} -->

					@include('tablerow')
				</tr>

			</table>
		</div>
	</div>

</div>
	
		@include('cardModal')
	</div>
	
	

@endsection
