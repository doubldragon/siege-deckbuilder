
function Controller($scope,$location) {

	$scope.cards = deck.cardlist;
	$scope.selected = false;
	$scope.isMonarch =true;

	$scope.toggleFaction = function (isMonarch) {
		console.log('hello');
		$scope.isMonarch = isMonarch;
		console.log($scope.isMonarch);
	}	
}