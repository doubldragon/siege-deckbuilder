
function Controller($scope) {

	$scope.cards = deck.cardlist;
	$scope.selectLead = false;
	$scope.isMonarch = true;
	console.log($scope);
	$scope.toggleFaction = function (isMonarch) {
		console.log('hello');
		$scope.isMonarch = isMonarch;
		console.log($scope.isMonarch);
	}

	$scope.updateQty = function (value, card) {
		card.quantity = value;
		console.log(value);
		console.log("card quantity = ", card.quantity);
		if (card.quantity == 0){
			card.selected = false;
			console.log(card.name, "is zero!");
		} else {
			card.selected = true;
			console.log(card.name, "is selected!");
		}
		
		return card;
	}

	$scope.checkQty = function(card) {

	}

	
}