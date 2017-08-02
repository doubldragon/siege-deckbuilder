
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

	$scope.updateQty = function (value) {
		console.log("Value is: ", value);
	}

	
}