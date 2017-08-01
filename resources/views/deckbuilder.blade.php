@extends ('layouts.app')


@section('content')

	<div class='container text-center' ng-app="app" ng-controller="Controller">
		<h1>Siege! Deckbuilder</h1>

		<p>Create New Deck</p>
		<form class='form-inline' >
			<div class='form-group' style='margin: 0 auto;'>	
				<input type="text" name="deckName" placeholder="Name Your Deck">
		    
			<!-- Use a Toggle switch to select Faction -->
		    <select class="form-control" id="factionSelect" name="factionSelect">
		      <option name='faction' value=''>Select Faction</option>
		      <option name='faction' value='Monarch'>Monarch</option>
		      <option name='faction' value='Invader'>Invader</option>
		    </select>
				<button class='btn btn-primary' value='submit' name='createDeck'>Create Deck</button>
			</div>
		
		</form>
		<br />
		<p>or Select Existing Deck to Edit</p>
		<br />
		<form class='form-inline'>
			<div class="form-group" style='margin: 0 auto;'>
		    <select class="form-control" id="factionSelect" name="factionSelect">
		      <option name='faction' value=''>Select Faction</option>
		      <option name='faction' value='Monarch'>Monarch</option>
		      <option name='faction' value='Invader'>Invader</option>
		    </select>
		
		    <select class="form-control" id="factionSelect" name="factionSelect">
		      <option name='faction' value=''>Choose Deck</option>
		      <option name='faction' value='sampleDeck'>Sample Deck Name</option>
		      <option name='faction' value='anotherDeck'>Another Deck</option>
		    </select>
				<button class='btn btn-primary' value='submit'>Select Deck</button>
			</div>
		</form>
		<div class="alert alert-success" role="alert">
		  <strong>Well done!</strong> Messaging will go here.
		</div> 
		<h2>Card Selector</h2>
		<div class='row'>
			<div class='col' id='myDeck'>
				<div class='card card-block bg-faded'>
					<h3 class="card-header">My Deck</h3>
					<hr>
					<h4>Spaces remaining</h4>
				</div>
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
					<tr ng-repeat="card in cards">
						<td>
							0-3
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
				<form>
					<button class='btn btn-primary' value='submit' name='saveDeck'>Save Deck</button>
					<button class='btn btn-outline-danger' value='submit' name='deleteDeck'>Delete Deck</button>
				</form>
			</div>
			
		</div>
	</div>
	
	<script>
	function Controller($scope,$location) {
		$scope.cards = setupCards({!! $cards !!});
	}
	</script>
	<script src="/deckbuilder.js"></script>
@endsection
