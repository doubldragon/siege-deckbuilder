@extends ('layouts.app')


@section('content')


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="row">
	<div class="mt-3 col col-sm-8 col-sm-offset-2 panel panel-default" style="padding-left: 0;padding-right: 0;">
	 	<div class="panel-heading text-center" style="width:100%;">
			<strong><h3 style="margin:0;">Richard the Lesser</h3></strong>
	 	</div>
	 	<div class="row">
	 		<div class="col">
	 			<img src='img/richard.png' height="100px" width="100px">
	 		</div>
	 		<div class="ml-3 col">
	 			<p style="color:#000;"><strong>Action: </strong>it's a party</p>
	 			<!-- <hr> -->
	 			<p style="color:#000;"><strong>Effect: </strong>it's a party</p>
	 			<strong>5</strong> <img src="https://png.icons8.com/coins-filled/ios7/25" title="Coins Filled" width="15" height="15"> 
	 			<strong> &nbsp &nbsp 5</strong> <img src="https://png.icons8.com/ruby-gemstone-filled/ios7/25" title="Coins Filled" width="15" height="15">

	 		</div>
	 	</div>
	 	<div class="panel-footer text-center" style="padding:5px;">
			<button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
  Popover on left
</button>
	 	</div>
	</div>
</div>
    </div>
  </div>
</div>


@endsection