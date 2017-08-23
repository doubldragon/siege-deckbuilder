
function Controller($scope, $http) {
	$scope.cards = deck.cardlist;
	// console.log($scope.cards);
	$scope.decks = deck.decks;
	$scope.selectLead = false;
	$scope.deckPoints = 0;
	$scope.maxPoints = 75;
	$scope.deckName="";
	$scope.isPrivate= false;
	$scope.isMonarch = true;
	$scope.isEdit = false;
	$scope.allDecks = deck.allDecks;
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
	


	
	$scope.getTotal = function () {
		// console.log($scope.cards);
		
		$scope.deckPoints = 0;
		$scope.cards.forEach(function (card) {
		$scope.deckPoints += card.quantity * card.deck_points;

		});
	}
	if (deck.isEdit){
		$scope.cards = deck.cardlist;
		$scope.leader = deck.editDeck.leader;
		$scope.selectLead = true;
		$scope.deck_id = deck.editDeck.id;
		$scope.deckName = deck.editDeck.name;
		$scope.isEdit = true;
		$scope.editAction =  "../api/decks/" + $scope.deck_id;
		$scope.isMonarch = deck.editDeck.isMonarch;
		$scope.getTotal();
	}

	$scope.previewDeck = function (deck) {
		$scope.preLeader = deck.leader.name;
		$scope.preFaction = deck.faction;
		$scope.deckOwner = deck.user_id;
		$scope.previewCards = deck.cards;
		$scope.editAction = "/decks/" + deck.id;
		$scope.deleteAction = "/api/decks/" + deck.id;
		$scope.activeDeck = deck.id;
	}

	$scope.resetForm = function ()
	{
		$scope.selectLead = false;
		$scope.newExisting = false;
		$scope.selectFaction = false;
		$scope.cards.forEach(function (card) {
			card.quantity = 0;
			card.selected = false;
		});
		$scope.deckName = "";
		deck.isEdit = false;
		$scope.isEdit = false;
		$scope.decks = deck.decks;
		$scope.deckPoints = 0;

	}

	$scope.checkOwner = function (user) {
		return (user == $scope.deckOwner);
	}
	

	$scope.toggleFaction = function (isMonarch) {
		$scope.isMonarch = isMonarch;
		
	}

	$scope.updateQty = function (value, card) {
		card.quantity = value;
		if (card.quantity == 0){
			card.selected = false;
		} else {
			card.selected = true;
		}
		$scope.getTotal();
		return card;
	};

	$scope.revealCards = function(card) {
		$scope.selectLead = true;
		$scope.leader = card;

	}

	$scope.checkQty = function (qty, button){
		return (qty == button ? true : false);
	}

	$scope.openDeck = function (){
		$scope.deckSelect = JSON.parse($("#deckSelect option:selected").val());
		$scope.leader = $scope.deckSelect.leader;
		$scope.cards = JSON.parse($scope.deckSelect.cards);
		$scope.deckPoints = $scope.getTotal();
		$scope.selectLead = true;
	}
	
	$scope.cardModal = function (card){
		$scope.mCard = card;
		}

	$scope.typeFilter = function (value) { 
		$scope.displayFilter[value] = !$scope.displayFilter[value];
	}
	
	$scope.toggleFilter = function (value) {
		var typeArray = ["leader","castle", "food", "morale", "engine","defense","spy"];
		console.log(value);
		return $scope.displayFilter[typeArray[value-1]];
	}

	$scope.checkScope = function () {
	}
}