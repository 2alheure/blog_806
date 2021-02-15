<?php

include_once './fonctions/fonctions_bdd.php';

if (
	// On DOIT vérifier les données qu'on reçoit

	!empty($_POST['titre'])
	&& !empty($_POST['contenu'])
	&& !empty($_POST['image'])
	&& !empty($_POST['image_alt'])
	&& !empty($_POST['image_copyright'])
) {
	$bdd = connectDB();

	$requete = 'INSERT INTO articles (titre, contenu, image, image_alt, image_copyright, date) 
							VALUE (?, ?, ?, ?, ?, ?)';

	$statement = $bdd->prepare($requete);
	$date = date('Y-m-d');			// aaaa-mm-jj

	$statement->bindParam(1, $_POST['titre']);
	$statement->bindParam(2, $_POST['contenu']);
	$statement->bindParam(3, $_POST['image']);
	$statement->bindParam(4, $_POST['image_alt']);
	$statement->bindParam(5, $_POST['image_copyright']);
	$statement->bindParam(6, $date);

	$statement->execute();
}

else {
	header('location: creer-article.php');
	die;
}