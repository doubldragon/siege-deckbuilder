
function Controller($scope, $http) {
	$scope.cards = deck.cardlist;
	$scope.decks = deck.decks;
	$scope.selectLead = false;
	$scope.deckName="";
	$scope.isPrivate= false;
	$scope.isMonarch = true;
	// $scope.stringDeck = "Ready to stringify deck!";
	// $scope.jsonDeck= "This will become json";
	
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
		$scope.preLeader = deck.name;
	}	
}