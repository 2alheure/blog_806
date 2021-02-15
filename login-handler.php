<?php

include_once 'fonctions/fonctions_bdd.php';
include_once 'fonctions/mes_fonctions.php';
session_start();


if (
	!empty($_POST['pseudo'])
	&& !empty($_POST['password'])
) {

	$utilisateur = getUtilisateurByPseudo($_POST['pseudo']);

	if ($utilisateur === false) {		// S'il y a une erreur (par exemple : on n'a pas trouvé l'utilisateur)

		$_SESSION['erreur'] = 'Mauvais pseudo';
		
		header('location: login.php');	// on redirige vers la page de connexion
		die;
	} else {

		if (password_verify($_POST['password'], $utilisateur['password'])) {

			createSession($utilisateur);

			if ($_POST['rester-connecte'] == 'true') {		// Si la case est cochée
				// On calcule le timestamp de "dans un an"
				$dans_un_an = time() + 365 * 24 * 60 * 60;

				setcookie('user_id', $utilisateur['id'], $dans_un_an);
			}

			header('location: index.php');
			die;
		} else {
			$_SESSION['erreur'] = 'Mauvais mot de passe';
			
			header('location: login.php');	// on redirige vers la page de connexion
			die;
		}
	}
} else {
	$_SESSION['erreur'] = 'Il manque un champ';
	
	header('location: login.php');	// on redirige vers la page de connexion
	die;
}
