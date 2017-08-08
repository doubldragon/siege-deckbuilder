<td class="selector">
								<form class="btn-group" >
								  <label class="btn btn-sm btn-info" ng-class="{active:checkQty(card.quantity,0)}">
								    <input type="radio" id="option1" value="0" data-ng-model="card.quantity" ng-change="updateQty(0,card)">0
								  </label>
								  <label class="btn btn-sm btn-info" ng-class="{active:checkQty(card.quantity,1)}">
								    <input type="radio" id="option2" value="1" data-ng-model="card.quantity" ng-change="updateQty(1,card)">1
								  </label>
								  <label class="btn btn-sm btn-info" ng-class="{active:checkQty(card.quantity,2)}">
								    <input type="radio" id="option3" value="2" data-ng-model="card.quantity" ng-change="updateQty(2,card)">2
								  </label>
								  <label class="btn btn-sm btn-info" ng-class="{'active':checkQty(card.quantity,3)}">
								    <input type="radio" id="option4" value="3" data-ng-model="card.quantity" ng-change="updateQty(3,card)">3
								  </label>
								</form>
								
								
							</td>
							<td>
								[[card.name]]
							</td>
							<td>
								[[card.deck_points]]
							</td>
							<td>
								<img src="[[card.type_icon]]" width="25" height="25">
							</td>