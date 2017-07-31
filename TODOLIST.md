 
#TODO LIST

# Database
 - Verify Setup of User/Admin logins
 - Design Schema for Tables
 	- Roles
 		- id
 		- role name
 	- Users
 		- standard fields with laravel auth
 		- one exception: replace `Name` with `username` (unique)
 	- Decks
		- id
		- deck name
		- user_id
		- timestamps
 	- Cards
 		- id
 		- faction (Invader/Monarch)
 		- type (leader,castle, normal)
 		- name
 		- class (food production, morale, etc)
 		- deck points
 		- cost
 		- action
 		- side effects
 		- flavor text
 		- timestamps

 - Create migrations and controllers
 - Seed database

# Deckbuilder

 - Select Faction
 - Select Leader
 - Select Castle (if monarch is chosen)
 - Display available cards in right side pane
 - selected cards leave the right side pane and appear in the left side pane
