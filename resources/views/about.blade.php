@extends ('layouts.app')

@section ('content')
<div class="container container-fluid ">
	<div class="row col-lg-8 col-lg-offset-2" style="background-color: rgba(82, 153, 211,0.9);">
		<div class="col-md-8">
			<h2 class="aboutHeader">About Siege!</h3>
			<p class="aboutText">
				Siege! is an asymmetric, deck building card game of strategy for control of the realm.
			</p>
			<h3 class="aboutHeader">What do you mean by "asymmetric"? </h4><br>
			<p class="aboutText">
				In Siege! there are two factions, the Monarch and the Invader. The Monarch is lord of his castle, but has found himself in a pickle. An Invader has arrived at his doorstep and laid siege to the castle. The Invader clearly has conquest on his mind and the King is just hoping to keep his people fed and survive. Their goals are different and require vastly different strategies.
			</p>
			<h3 class="aboutHeader">How does Deckbuilding Work?</h4><br>
			<p class="aboutText">
				Each faction, Monarch and Invader, has their own deck with cards specifically designed to aid them in their cause. As a player, you select cards from the pool of cards to optimize your ability to protect your castle from being sacked, or to lay waste to to another Monarch standing in your way.

				This tool will allow you to easily view the cards in your arsenal, build and save decks for gameplay online or tabletop. Full disclosure: the game doesn't exist yet, but it's coming!
			</p>
		</div>
		<div class="col-md-4 text-center">
			<img src="img/leaderstack.png" class="leaderStack" height="50%" width="50%">
		</div>
	</div>
	<div class="mb-5 row col-lg-8 col-lg-offset-2" style="background-color: rgba(82, 153, 211,0.9);">
		<div class="mb-2 col-md-8">
			<h2 class="aboutHeader">About the Creator</h3>
			<p class="aboutText">
				<a class="aboutLink" href="http://brandonspencer.me" target="_blank">Brandon Spencer</a> is a Web Developer, Polymath, and a Tinkerer. He has over ten years of leadership experience, and finding creative solutions to problems. In addition to taking things apart, he also enjoys putting things back together. 
			</p>
		</div>
		<div class="mb-2 col col-md-4">
			<img class="mt-5" src="img/profile.jpg" height="240px" width="240px">
		</div>
	</div>
</div>

@endsection
