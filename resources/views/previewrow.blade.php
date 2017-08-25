<div class="col deckDisplay">
    
    <div class="row " ng-show="checkOwner({{Auth::User()->id}})">
        <span class="pull-right">
            <form class="form-inline" method="post" action="[[editAction]]">
                {{method_field('GET')}}
                <button class='btn btn-sm btn-outline-primary ' type="submit" >Edit</button>
            </form>
        </span>
        <span class="pull-right">
            <form class="form-inline" method="post" action="[[deleteAction]]">
                {{method_field('DELETE')}}
                <button class='btn btn-sm btn-outline-danger ' type="submit" >Delete</button>
            </form>
        </span>
    </div>
    
    <h4 class="mt-4 mb-2" ng-show="preLeader">[[preLeader]] - [[preFaction]]</h4>
    
    <ul>
        
        <li ng-repeat="card in previewCards" ng-click="cardModal(card)"><a href='#' data-toggle="modal" data-target="#myModal">[[card.quantity]]x [[card.card.name]]</a></li>
    </ul>

</div>