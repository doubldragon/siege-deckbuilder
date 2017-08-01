 
#TODO LIST

# Database
<!-- - Verify Setup of User/Admin logins - DONE -->
<!-- - Design Schema for Tables -->
- Users
- standard fields with laravel auth
 		- replace `Name` with `username` (unique)
 		- isAdmin (default is false)
 	- Decks
		- id
		- deck name
		- user_id
		- timestamps
	- Card Types
		- id
		- type (leader, castle, normal)
 	- Cards
 		- id
 		- isMonarch (Invader if false)
 		- type (leader,castle, food production, morale, etc)
 		- name
 		- deck points
 		- cost
 		- action
 		- side effects
 		- flavor text
 		- timestamps
 	- Decks_Cards
 		- deck_id
 		- card_id
 		- quantity

 - Create migrations and controllers
 - Seed database

# Deckbuilder

 - Select Faction
 - Select Leader
 - Select Castle (if monarch is chosen)
 - Display available cards in right side pane
 - selected cards leave the right side pane and appear in the left side pane
