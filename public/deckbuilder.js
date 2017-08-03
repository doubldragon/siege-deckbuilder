
function Controller($scope) {

	$scope.cards = deck.cardlist;
	$scope.selectLead = false;
	$scope.isMonarch = true;
	$scope.stringDeck = "Ready to stringify deck!";
	$scope.jsonDeck= "This will become json";
	
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

	$scope.stringifyDeck = function(deck) {
		$scope.stringDeck = JSON.stringify(deck);
		$scope.jsonDeck = JSON.parse($scope.stringDeck);
		console.log($scope.jsonDeck);
	}
	
}