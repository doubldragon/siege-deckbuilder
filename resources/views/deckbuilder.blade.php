@extends ('layouts.app')


@section('content')

	<div class='container text-center' ng-app="app" ng-controller="Controller">
		<h1 class="banner">Siege! Deckbuilder</h1>
		<div ng-hide="selectLead">
			<div ng-hide="newExisting">
			<button class="btn btn-primary" ng-click="newExisting=true;">Create New Deck</button>
			<br /><br />
			<p class="mb-1">or Select Existing Deck to Edit</p>
			
			<form class='form-inline'>
				<div class="form-group" style='margin: 0 auto;'>
			    	
			    <select class="form-control" id="deckSelect" name="deckSelect">
			      <option name='' value=''>Choose Deck</option>
			      <option name='deckSelect' ng-repeat="deck in decks" value="[[deck]]">[[deck.name]]</option>
			    </select>
					<button class='btn btn-primary' type="submit" ng-click='openDeck()'>Select Deck</button>
				</div>
			</form>
			</div>
			<!-- <form class='form-inline' > -->
				<div ng-show="newExisting" class='form-group' style='margin: 0 auto;'>	
					
				<button class="btn btn-primary mr-1 ml-1 mb-4" ng-click="isMonarch=true; selectFaction=true;">Monarch</button>
				<button class="btn btn-primary mr-1 ml-1 mb-4" ng-click="isMonarch=false; selectFaction=true;">Invader</button>
				<!-- <hr> --><br />

				<!-- <button ng-show="selectFaction" ng-class="{'btn-primary': [[isMonarch]], 'btn-danger': ![[isMonarch]]}" class="btn mr-1 ml-1" ng-click="revealCards(card)" ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {type_id: 1}" >[[card.name]]</button> -->
				<div class="col-md-4 center-block" ng-show="selectFaction"   ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {type_id: 1}" >
				<div class="panel panel-default deckHeader" >
					<div class=" col-sm-12 panel-heading">  [[card.name]]     </div>
					<div class="panel-body">
						[[card.flavor_text]] <br />
						<button ng-class="{'btn-primary': [[isMonarch]], 'btn-danger': ![[isMonarch]]}" class="btn mr-1 ml-1" ng-click="revealCards(card)">[[card.name]]</button>

					</div>
				</div>
				</div>
			<!-- </form> -->
			</div>
		</div>
		

		<div ng-show="selectLead">
			<button class="btn btn-primary mb-3" ng-click="resetForm()">Reset Builder</button>
			<div class='row'>

				<div class='col col-md-6' id='myDeck'>
					<div class="panel panel-default deckHeader">
                		<div class="panel-heading " >
                			<h4 style="display:inline-block"><strong>[[leader.name]]</strong></h4> - 
							<h5 style="display:inline-block"> [[leader.flavor_text]]</h5>
            			</div>

                		<div class="panel-body">
		                   	<div class="row">
		                   		<div class= "col col-sm-4">
		                   			Picture
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
					<div class="panel panel-default deckHeader">
                		<div class="panel-heading " >
                			<h4 style="display:inline-block">Available Cards</h4>
            			</div>

                		<div class="panel-body">
		                   	<div class="row">
		                   		<div class="col col-sm-6">
		                   			
		                   			<input id="searchBar" type="text" placeholder="Search for card..." ng-model="searchText">
		                   		</div>
		                   		<div class="col col-sm-6">
		                   			<div class="btn-group" >
									  <label class="btn btn-default" ng-class="{'active': displayFilter['food']}">
									    <input type="checkbox" ng-click="typeFilter('food')"> 2 
									  </label>
									  <label class="btn btn-default" ng-class="{'active': displayFilter['morale']}">
									    <input type="checkbox" ng-click="typeFilter('morale')"> 2 
									  </label>
									  <label class="btn btn-default" ng-class="{'active': displayFilter['engine']}">
									    <input type="checkbox" ng-click="typeFilter('engine')"> 3 
									  </label>
									  <label class="btn btn-default" ng-class="{'active': displayFilter['defense']}">
									    <input type="checkbox" ng-click="typeFilter('defense')"> 3 
									  </label>
									  <label class="btn btn-default" ng-class="{'active': displayFilter['spy']}">
									    <input type="checkbox" ng-click="typeFilter('spy')"> 3 
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
			<div class='row'>
				<div class='col'>
					<form method='post' action="/api/decks" ng-hide="isEdit"> 
						{{ method_field('POST')}}
						<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
						<input type="hidden" name="userDeck" value="[[cards]]">
						<input type="hidden" name="lead_id" value="[[leader.id]]">
						<input type="hidden" name="isMonarch" value="[[leader.isMonarch]]">
						<!-- <input type="checkbox" name="isPrivate" ng-model="isPrivate">Check to make this deck Private<br /> -->
						<input type="text" name="name" ng-model="deckName"  placeholder="Name Your Deck">

						
						<button class='btn btn-primary' value="submit"  name='saveDeck'>Save Deck</button>
						<!-- <button class='btn btn-outline-danger' value='submit' name='deleteDeck'>Delete Deck</button> -->
					</form>
					<form method='post' action="[[editAction]]" ng-show="isEdit"> 
						{{ method_field('PUT')}}
						<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
						<input type="hidden" name="deck_id" value="[[deck_id]]">
						<input type="hidden" name="userDeck" value="[[cards]]">
						<input type="hidden" name="lead_id" value="[[leader.id]]">
						<input type="hidden" name="isMonarch" value="[[leader.isMonarch]]">
						<!-- <input type="checkbox" name="isPrivate" ng-model="isPrivate">Check to make this deck Private<br /> -->
						<input type="text" name="name" ng-model="deckName" placeholder="Name Your Deck">

						
						<button class='btn btn-primary' value="submit"  name='saveDeck'>Save Edit</button>
						<!-- <button class='btn btn-outline-danger' value='submit' name='deleteDeck'>Delete Deck</button> -->
					</form>
				</div>
				
			</div>
		</div>
	</div>
	<!-- ng-click="saveDeck({{Auth::User()->id}}, deckName, cards)" -->
	
	

@endsection
