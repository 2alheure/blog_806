<?php

if (!empty($_COOKIE['pseudo'])) $pseudo = $_COOKIE['pseudo'];
else $pseudo = null;

$titre = 'Se connecter | Mon super blog';
include_once 'layout/header.php';

?>

<h1 class="mb-4">Se connecter</h1>
<form action="login-handler.php" method="post">
	<div class="form-group">
		<label for="pseudo">Pseudo</label>
		<input type="text" class="form-control" name="pseudo" id="pseudo" aria-describedby="pseudo-help" placeholder="Pseudo" required autofocus value="<?php echo $pseudo; ?>">
	</div>


	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" class="form-control" name="password" id="password" aria-describedby="password-help" placeholder="Mot de passe" required>
	</div>

	<div class="form-group form-check">
		<label class="form-check-label">
			<input type="checkbox" class="form-check-input" name="rester-connecte" id="rester-connecte" value="true">
			Rester connecté
		</label>
	</div>


	<button type="submit" class="btn btn-primary">Se connecter</button>
</form>


<?php include_once 'layout/footer.php';
