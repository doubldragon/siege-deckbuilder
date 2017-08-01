
function Controller($scope,$location) {

	$scope.cards = deck.cardlist;
	
	$scope.isMonarch = true;

	$scope.toggleFaction = function () {
		$scope.isMonarch = !$scope.isMonarch;
	}	
	}