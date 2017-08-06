@extends ('layouts.app')


@section('content')

	<div class='container text-center' ng-app="app" ng-controller="Controller">
		
			

			<div class='row'>
				<div class='col' id='myDeck'>
						<h3>[[deckName]]</h3>
						<h4> Leader: [[leader.name]] </h4>
						<h4> Effect: [[leader.flavor_text]] </h4>
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
					<h3>Available Cards</h3>
					<table class="table table-hover">
						<tr>
							<th class>Qty</th>
							<th>Name</th>
							<th>Points</th>
							<th>Action</th>
						</tr>
						<tr ng-repeat="card in cards | filter: {isMonarch: isMonarch} | filter: {display: true} ">
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
						<input type="text" name="name" ng-model="deckName" placeholder="Name Your Deck">

						
						<button class='btn btn-primary' value="submit"  name='saveDeck'>Save Deck</button>
						<!-- <button class='btn btn-outline-danger' value='submit' name='deleteDeck'>Delete Deck</button> -->
					</form>
				</div>
				
			</div>
	</div>
	<!-- ng-click="saveDeck({{Auth::User()->id}}, deckName, cards)" -->
	
	

@endsection
