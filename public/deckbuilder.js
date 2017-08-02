
function Controller($scope,$location) {

	$scope.cards = deck.cardlist;
	$scope.selectLead = false;
	$scope.isMonarch = true;
	// $scope.$watch('selectLead', () => {
	// 	console.log($scope.selectLead);
	// });
	$scope.toggleFaction = function (isMonarch) {
		console.log('hello');
		$scope.isMonarch = isMonarch;
		console.log($scope.isMonarch);
	}

	
}