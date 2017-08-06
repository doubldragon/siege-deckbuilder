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

				<button ng-show="selectFaction" ng-class="{'btn-primary': [[isMonarch]], 'btn-danger': ![[isMonarch]]}" class="btn mr-1 ml-1" ng-click="revealCards(card)" ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {type_id: 1}" >[[card.name]]</button>
				
				</div>
			<!-- </form> -->
			
		</div>
		

		<div ng-show="selectLead">
			
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
							<td class="selector">
								<form class="btn-group" >
								  <label class="btn btn-sm btn-info">
								    <input type="radio" id="option1" value="0" ng-model="card.quantity" ng-change="updateQty(0,card)">0
								  </label>
								  <label class="btn btn-sm btn-info">
								    <input type="radio" id="option2" value="1" ng-model="card.quantity" ng-change="updateQty(1,card)">1
								  </label>
								  <label class="btn btn-sm btn-info">
								    <input type="radio" id="option3" value="2" ng-model="card.quantity" ng-change="updateQty(2,card)">2
								  </label>
								  <label class="btn btn-sm btn-info">
								    <input type="radio" id="option4" value="3" ng-model="card.quantity" ng-change="updateQty(3,card)">3
								  </label>
								</form>
								
								
							</td>
							<td>
								[[card.name]]
							</td>
							<td>
								[[card.deck_points]]
							</td>
							<td>
								[[card.action]]
							</td>
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
		                   			Checkbox filter here
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
						<tr ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {display: true} | filter: searchText ">
						<!-- | filter: {selected: false} -->
							<td class="selector">
								<form class="btn-group" >
								  <label class="btn btn-sm btn-info active">
								    <input type="radio" id="option1" value="0" data-ng-model="card.quantity" ng-change="updateQty(0,card)">0
								  </label>
								  <label class="btn btn-sm btn-info">
								    <input type="radio" id="option2" value="1" data-ng-model="card.quantity" ng-change="updateQty(1,card)">1
								  </label>
								  <label class="btn btn-sm btn-info">
								    <input type="radio" id="option3" value="2" data-ng-model="card.quantity" ng-change="updateQty(2,card)">2
								  </label>
								  <label class="btn btn-sm btn-info">
								    <input type="radio" id="option4" value="3" data-ng-model="card.quantity" ng-change="updateQty(3,card)">3
								  </label>
								</form>
								
								
							</td>
							<td>
								[[card.name]]
							</td>
							<td>
								[[card.deck_points]]
							</td>
							<td>
								[[card.action]]
							</td>
						</tr>

					</table>
				</div>
			</div>
			<div class='row'>
				<div class='col'>
					<form method='post' action="/api/decks"> 
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
				</div>
				
			</div>
		</div>
	</div>
	<!-- ng-click="saveDeck({{Auth::User()->id}}, deckName, cards)" -->
	
	

@endsection
