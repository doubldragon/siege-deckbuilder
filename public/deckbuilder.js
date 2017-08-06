
function Controller($scope, $http) {
	$scope.cards = deck.cardlist;
	
	$scope.decks = deck.decks;
	$scope.selectLead = false;

	$scope.deckName="";
	$scope.isPrivate= false;
	$scope.isMonarch = true;
<<<<<<< Updated upstream
	console.log(deck);
=======
	$scope.isEdit = false;
	$scope.deckName = "Untitled Deck";
	$scope.searchText = "";
	$scope.newExisting = false;
	$scope.selectFaction = false;

>>>>>>> Stashed changes
	if (deck.isEdit){
		
		// $scope.deckSelect = JSON.parse($("#deckSelect option:selected").val());
		
		console.log(deck.cards);
		// return;
		$scope.cards = JSON.parse(deck.cards);
		console.log($scope.cards);

		$scope.selectLead = true;
		$scope.deckName = $scope.deckSelect.name;
	}

	$scope.toggleFaction = function (isMonarch) {
		console.log('hello');
		$scope.isMonarch = isMonarch;
		console.log($scope.isMonarch);
	}

	$scope.updateQty = function (value, card) {
		card.quantity = value;
		if (card.quantity == 0){
			card.selected = false;
		} else {
			card.selected = true;
		}
		
		return card;
	};

	$scope.revealCards = function(card) {
		$scope.selectLead = true;
		$scope.leader = card;

	}

	$scope.deckAsString = function(deck) {
		console.log(deck);

		// console.log(JSON.stringify(deck).slice(1,-1));
		return JSON.parse(JSON.stringify(deck).slice(1,-1));
	}

	$scope.openDeck = function (){
		$scope.deckSelect = JSON.parse($("#deckSelect option:selected").val());
		
		console.log($scope.deckSelect);
		// return;
		$scope.cards = JSON.parse($scope.deckSelect.cards);
		console.log($scope.cards);

		$scope.selectLead = true;
		$scope.deckName = $scope.deckSelect.name;
	}
	
	$scope.previewDeck = function (deck) {
		$scope.preLeader = deck.leader.name;
		$scope.preFaction = deck.faction;
		$scope.previewCards = JSON.parse(deck.cards);
		$scope.editAction = "/api/decks/" + deck.id;
		$scope.activeDeck = deck.id;
	}	

	$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
}