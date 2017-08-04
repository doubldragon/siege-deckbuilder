@extends ('layouts.app')


@section('content')

	<div class='container text-center' ng-app="app" ng-controller="Controller">
		<h1>Siege! Deckbuilder</h1>
		<div ng-hide="selectLead">
		<p>Create New Deck</p>
		<form class='form-inline' >
			<div class='form-group' style='margin: 0 auto;'>	
				
			<button ng-click="isMonarch=true;">Monarch</button>
			<button ng-click="isMonarch=false;">Invader</button>
			<hr>
			<button class="btn btn-success" ng-click="revealCards(card)" ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {type_id: 1}" >[[card.name]]</button>
			
			</div>
			<!-- <p ng-show="selectLead">Ta Daaaa!</p> -->
		</form>
		<br />
		<p>or Select Existing Deck to Edit</p>
		<br />
		<form class='form-inline'>
			<div class="form-group" style='margin: 0 auto;'>
		    <select class="form-control" id="factionSelect" name="factionSelect">
		      <option name='deckSelect' value=''>Select Faction</option>
		      <option name='deckSelect' value=''>[[decks.name]]</option>
		      
		    </select>
		
		    <select class="form-control" id="factionSelect" name="factionSelect">
		      <option name='faction' value=''>Choose Deck</option>
		      <option name='deckSelect' value='[[deck.id]]' ng-repeat="deck in decks">[[deck.name]]</option>
		    </select>
				<button class='btn btn-primary' value='submit'>Select Deck</button>
			</div>
		</form>
		<div class="alert alert-success" role="alert">
		  <strong>Well done!</strong> Messaging will go here. 
		</div> 
		<button class='btn btn-primary' value='4' ng-click="updateQty(value)">Select function</button>
		</div>
		

		<div ng-show="selectLead">
			<h2>Card Selector</h2>
			<div class='row'>
				<div class='col' id='myDeck'>
						<h3>My Deck</h3>
						<h4> Leader: [[leader.name]] </h4>
						<h4> Effect: [[leader.effect]] </h4>
						<table class="table table-hover">
						<tr>
							<th class>Qty</th>
							<th>Name</th>
							<th>Deck Points</th>
							<th>Action</th>
						</tr>
						<tr ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {display: true} | filter: {selected: true}">
							<td>
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
					<h3>Available Cards</h3>
					<table class="table table-hover">
						<tr>
							<th class>Qty</th>
							<th>Name</th>
							<th>Deck Points</th>
							<th>Action</th>
						</tr>
						<tr ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {display: true} ">
						<!-- | filter: {selected: false} -->
							<td>
								<form class="btn-group" >
								  <label class="btn btn-sm btn-info active">
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
			</div>
			<div class='row'>
				<div class='col'>
					<form method='post' > 
						<!-- {{ method_field('POST')}} -->
						<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
						<!-- <input type="hidden" name="cards" value="[[deckAsString(cards)]]"> -->
						<input type="text" name="name" placeholder="Name Your Deck">

						<button class='btn btn-primary' ng-click="saveDeck({{Auth::User()->id}},name, cards)" name='saveDeck'>Save Deck</button>
						<button class='btn btn-outline-danger' value='submit' name='deleteDeck'>Delete Deck</button>
						<button class='btn btn-primary' ng-click="stringifyDeck(cards)">Stringify</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
	
	
	<!-- <script src="/deckbuilder.js"></script> -->
	<!-- <script>cards = setupCards(deck.cardlist);</script> -->
@endsection
