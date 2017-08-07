
function Controller($scope, $http) {
	$scope.cards = deck.cardlist;
	$scope.decks = deck.decks;
	$scope.selectLead = false;

	$scope.deckName="";
	$scope.isPrivate= false;
	$scope.isMonarch = true;
	$scope.isEdit = false;

	$scope.deckName = "Untitled Deck";
	$scope.searchText = "";
	$scope.newExisting = false;
	$scope.selectFaction = false;
	$scope.displayFilter = {
		food : true,
		morale : false,
		engine : false,
		defense : false,
		spy : false
	};

	


	if (deck.isEdit){
		$scope.cards = JSON.parse(deck.cardlist);
		$scope.leader = deck.editDeck.leader;
		$scope.selectLead = true;
		$scope.deck_id = deck.editDeck.id;
		$scope.deckName = deck.editDeck.name;
		$scope.isEdit = true;
		$scope.editAction =  "../api/decks/" + $scope.deck_id;
	}

	$scope.toggleFaction = function (isMonarch) {
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
		console.log("why hello!");
		$scope.selectLead = true;
		$scope.leader = card;

	}

	$scope.checkQty = function (qty, button){
		return (qty == button ? true : false);
	}

	$scope.openDeck = function (){
		$scope.deckSelect = JSON.parse($("#deckSelect option:selected").val());
		console.log($scope.deckSelect);
		$scope.leader = $scope.deckSelect.leader;
		$scope.cards = JSON.parse($scope.deckSelect.cards);

		$scope.selectLead = true;
		// $scope.deckName = $scope.deckSelect.name;
	}
	
	$scope.previewDeck = function (deck) {
		$scope.preLeader = deck.leader.name;
		$scope.preFaction = deck.faction;
		
		$scope.previewCards = JSON.parse(deck.cards);
		$scope.editAction = "/decks/" + deck.id;
		$scope.deleteAction = "/api/decks/" + deck.id;
		$scope.activeDeck = deck.id;
	}	

	$scope.typeFilter = function (value) { 
		$scope.displayFilter[value] = !$scope.displayFilter[value];
		// console.log($scope.displayFilter[value]);
		// $scope.toggleFilter(value);
	}
	
	$scope.toggleFilter = function (value) {
		var typeArray = ["leader","castle", "food", "morale", "engine","defense","spy"];
		// console.log(typeArray[value-1]);
		// console.log(typeArray[value-1], " is ", $scope.displayFilter[typeArray[value-1]]);
		return $scope.displayFilter[typeArray[value-1]];
	}
}