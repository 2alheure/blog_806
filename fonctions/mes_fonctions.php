<?php


function resume($article) {
	return substr($article['contenu'], 0, 200) . '...';
}

function affichage($article) { ?>


	<article class="list-group-item list-group-item-action" aria-current="true">
		<div class="d-flex w-100 justify-content-between">
			<h2 class="mb-1">
				<?php echo $article['titre']; ?>
			</h2>
			<small>
				<?php echo $article['date']; ?>
			</small>
		</div>
		<p class="mb-1">
			<?php echo resume($article); ?>
		</p>
		<small class="text-muted"><a href="<?php echo 'article.php?id=' . $article['id']; ?>">Lire l'article.</a></small>
	</article>


<?php }

/**
 * Crée la session qui correspond à l'utilisateur
 */
function createSession($utilisateur) {
	$_SESSION['is_connected'] = true;
	$_SESSION['pseudo'] = $utilisateur['pseudo'];
	$_SESSION['image'] = $utilisateur['image'];
	$_SESSION['email'] = $utilisateur['email'];
}

/**
 * Affiche l'erreur qui se trouve dans $_SESSION
 * et la supprime ensuite pour éviter qu'elle s'affiche partout
 */
function printError() {
	if (!empty($_SESSION['erreur'])) { ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Fermer</span>
			</button>
			<strong>Erreur : </strong> <?php echo $_SESSION['erreur']; ?>
		</div>

<?php
		unset($_SESSION['erreur']);
	}
}
