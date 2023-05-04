<?php
	include("./php/connect_check.php");
?>

<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<title>Accueil</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
		<link rel="stylesheet" type="text/css" href="./styles/style.css">
		<link rel="stylesheet" type="text/css" href="./styles/reception.css">
	</head>
	<body>
		<header>
			<a class="logo_index" href="#"><img src="./images/logo.svg" alt="logo"></a>
			<h1>Pictio-Univ</h1>
		</header>
		<main class="reception">
			<nav class="select">
				<button class=<?= $connect_check ? "inactive" : "active"; ?> id="guest" onclick=<?= $connect_check ? "swap_select_guest_connected()" : "swap_select('guest','player')"; ?>><p class=<?= $connect_check ? "inactive_text" : "active_text"; ?> id="guest_text">Invité</p></button>
				<button class=<?= $connect_check ? "active" : "inactive"; ?> id="player" onclick=<?= $connect_check ? "swap_select_player_connected()" : "swap_select('player','guest')"; ?>><p class=<?= $connect_check ? "active_text" : "inactive_text"; ?> id="player_text">Joueur</p></button>
			</nav>
			
			<div class=<?= $connect_check ? "hidden" : "show"; ?> id="guest_content">
				<div class="left">
					<div class="custom_character">
						<img src="./images/base_character.svg" alt="character" id="character">
						<button class="left_up"></button>
						<button class="left_down" onclick="removeBody()"></button>
						<button class="right_up"></button>
						<button class="right_down" onclick="addBody()"></button>
					</div>
				</div>

				<div class="right">
					<label>
						<p>Pseudo</p>
						<input type="text" name="pseudo" id="pseudo_guest" required>
						<p class="error hidden" id="msg_err">Le pseudo est requis</p>
					</label>

					<label>
						<p>Room Code <span onmousemove="cursor_help()" onmouseout="cursor_help_remove()">?</span></p>
						<input type="text" name="room_code" id="room_code_guest">
					</label>
					<div class="help hidden" name="help">Si vous ne mettez pas de code. Vous entrerez dans une partie publique aléatoire.</div>
					
					<nav>
						<button class="play" onclick="playGuest()">Jouer</button>
						<button class="host" onclick="hostGuest()">Héberger</button>
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
					<h2 id="pseudo"><?= isset($_SESSION["pseudo"]) ? $_SESSION["pseudo"] : ""; ?></h2>
					<img src=<?php
					
						if (isset($_SESSION["img"])) {
							$img_profile = $_SESSION["img"];
							echo "\"$img_profile\"";
						}
						else {
							echo "\"./images/base_character.svg\"";
						}
					?>
					alt="character">
				</div>

				<div class="right">
					<label>
						<p>Room Code <span onmousemove="cursor_help()" onmouseout="cursor_help_remove()">?</span></p>
						<input type="text" name="room_code" id="room_code_account">
					</label>
					<div class="help hidden" name="help">Si vous ne mettez pas de code. Vous entrerez dans une partie publique aléatoire.</div>

					<nav>
						<button class="play" onclick="playAccount()">Jouer</button>
						<button class="host" onclick="host()">Héberger</button>
					</nav>
				</div>
				
				<a href="./account.php" class="account">Mon compte</a>
			</div>
		</main>
		<script src="./scripts/custom_character.js"></script>
		<script src="./scripts/create_guest_account.js"></script>
		<script src="./scripts/create_game.js"></script>
		<script src="./scripts/reception.js"></script>
		<?= $connect_check ? "<script src=\"./scripts/reception_connected.js\"></script>" : ""; ?>
	</body>
</html>