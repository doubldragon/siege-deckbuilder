<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="row">
    <div class="mt-3 col col-sm-8 col-sm-offset-2 panel panel-default" style="padding-left: 0;padding-right: 0;">
        <div class="panel-heading text-center" style="width:100%;">
            <strong><h3 style="margin:0;">[[ mCard.name ]]</h3></strong>
        </div>
        <div class="row">
            <div class="col col-sm-4">
                <img src='[[mCard.type_icon]]' height="100px" width="100px">
            </div>
            <div class="col">
                <p style="color:#000;"><strong>Action: </strong>[[mCard.action]]</p>
                <!-- <hr> -->
                <p style="color:#000;"><strong>Effect: </strong>[[mCard.effect]]</p>
                <strong>[[mCard.cost]]</strong> <img src="https://png.icons8.com/coins-filled/ios7/25" title="Coins Filled" width="15" height="15"> 
                <strong> &nbsp &nbsp [[mCard.deck_points]]</strong> <img src="https://png.icons8.com/ruby-gemstone-filled/ios7/25" title="Coins Filled" width="15" height="15">

            </div>
        </div>
        <div class="panel-footer text-center" style="padding:5px;">
            <small>[[ mCard.flavor_text ]] </small>
        </div>
    </div>
</div>
    </div>
  </div>
</div>