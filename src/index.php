<?php
	session_start();

	$connect_check = isset($_SESSION["pseudo"], $_SESSION["email"]);
?>

<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<title>Accueil</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./styles/style.css">
		<link rel="stylesheet" type="text/css" href="./styles/reception.css">
	</head>
	<body>
		<main class="reception">
			<nav class="select">
				<button class="active" id="guest" onclick=<?= $connect_check ? "swap_select_guests_connected()" : "swap_select('guest','player')"; ?>>Invité</button>
				<button class="inactive" id="player" onclick=<?= $connect_check ? "swap_select_player_connected()" : "swap_select('player','guest')"; ?>>Joueur</button>
			</nav>
			
			<div class=<?= $connect_check ? "hidden" : "show"; ?> id="guest_content">
				<div class="left">
					<div class="custom_character">
						<img src="./images/base_character.svg" alt="character">
						<button class="left_up"></button>
						<button class="left_down"></button>
						<button class="right_up"></button>
						<button class="right_down"></button>
					</div>
				</div>

				<div class="right">
					<label>
						<p>Pseudo</p>
						<input type="text" name="pseudo">
					</label>

					<label>
						<p>Room Code <span>?</span></p>
						<input type="text" name="room_code">
					</label>
					<div id="info"></div>
					
					<nav>
						<button class="play">Jouer</button>
						<button class="host">Héberger</button>
					</nav>
				</div>
			</div>
			
			<div class="hidden" id="player_content">
				<nav class="center">
					<a href="./log_in.php">Connexion</a>
					<a href="./sign_in.php">Inscription</a>
				</nav>
			</div>

			<div class=<?= $connect_check ? "show" : "hidden"; ?> id="player_content_connected">
				<div class="left">
					<h2 id="pseudo"><?= $_SESSION["pseudo"]; ?></h2>
					<img src="./images/base_character.svg" alt="character">
				</div>

				<div class="right">
					<label>
						<p>Room Code <span>?</span></p>
						<input type="text" name="room_code">
					</label>
					<div id="info"></div>

					<nav>
						<button class="play">Jouer</button>
						<button class="host">Héberger</button>
					</nav>
				</div>
				
				<button class="account">Mon compte</button>
			</div>
		</main>
		<script src="./scripts/reception.js"></script>
	</body>
</html>