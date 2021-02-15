<?php

/**
 * Sert à se connecter à la BDD
 */
function connectDB() {
	include_once __DIR__ . '/../config/config_bdd.php';
	
	try {
		// On crée un nouvel objet
		$truc_muche = new PDO('mysql:host=' . $host . ';dbname=' . $dbName, $user, $password);

		// On le renvoie
		return $truc_muche;
	} catch (PDOException $e) {
		include __DIR__ . '/../erreurs/500.php';
		die();
	}
}

/**
 * Sert à récupérer 1 ou plusieurs articles
 * 
 * Si on donne $id, on récupère 1 article avec l'id = $id
 * Si on donne pas $id, on récupère TOUS les articles
 */
function getArticle($id = null) {

	if (!empty($id)) {
		// $id n'est pas "vide"

		// Si on a un $id,
		// On va chercher un unique article

		$bdd = connectDB();

		// Il y a une variable, INTERDICTION de faire un query
		$statement = $bdd->prepare('SELECT * FROM articles WHERE id = ?');

		$statement->bindParam(1, $id);

		if ($statement->execute()) return $statement->fetch();

		else return false;
	} else {

		// Si on n'a pas $id,
		// On va chercher TOUS les articles

		// getArticle() = getVariableArticle()
		$bdd_pdo = connectDB();

		// Il n'y a pas de variable, on peut faire un query
		$resultat = $bdd_pdo->query('SELECT * FROM articles');

		$variable_article = array();

		while ($article = $resultat->fetch()) {
			$variable_article[] = $article;
		}

		return $variable_article;
	}
}


/**
 * Sert à créer un utilisateur dans la BDD
 * A partir des données de formulaire POST
 */
function createUser() {
	/**
	 * Pas besoin d'accolades pour if et else 
	 * si on n'a qu'une seule instruction derrière
	 */
	if (empty($_POST['image'])) $image = null;	// Si $_POST['image] est vide, $image = null
	else {	// Sinon
		if (filter_var($_POST['image'], FILTER_VALIDATE_URL)) $image = $_POST['image'];	// Si elle est valide, on prend sa valeur
		else $image = null;		// Sinon, tant pis pour l'utilisateur, $image = null
	}

	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


	$bdd = connectDB();

	$requete = 'INSERT INTO utilisateurs (pseudo, email, image, password) VALUE (?, ?, ?, ?)';

	$statement = $bdd->prepare($requete);

	$statement->bindParam(1, $_POST['pseudo']);
	$statement->bindParam(2, $_POST['email']);
	$statement->bindParam(3, $image);
	$statement->bindParam(4, $password);

	$statement->execute();
}

/**
 * Sert à récupérer un utilisateur
 * en connaissant son pseudo
 */
function getUtilisateurByPseudo($pseudo) {

	$requete = 'SELECT * FROM utilisateurs WHERE pseudo = ?';

	$bdd = connectDB();

	$statement = $bdd->prepare($requete);

	$statement->bindParam(1, $pseudo);

	$statement->execute();

	$utilisateur = $statement->fetch();	// On va chercher une ligne de notre réponse

	return $utilisateur;
}
