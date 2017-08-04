
function Controller($scope, $http) {

	$scope.cards = deck.cardlist;
	$scope.decks = deck.decks;
	$scope.selectLead = false;
	$scope.deckName="";
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

	$scope.deckAsString = function(deck) {
		console.log(deck);

		// console.log(JSON.stringify(deck).slice(1,-1));
		return JSON.parse(JSON.stringify(deck).slice(1,-1));
	}

	$scope.saveDeck = function (id, name, cards) {
		console.log("saving deck");
		$scope.deck = {
			user_id : id,
			name: $scope.deckName,
			cards: cards
		};
		console.log($scope.deck);
		$http.post('/api/decks', $scope.deck);
	}
	
}