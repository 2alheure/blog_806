<?php

include_once './fonctions/fonctions_bdd.php';

if (
	// On DOIT vérifier les données qu'on reçoit

	!empty($_POST['titre'])
	&& !empty($_POST['contenu'])
	&& !empty($_POST['image_alt'])
	&& !empty($_POST['image_copyright'])


	// On vérifie pas $_POST mais $_FILES pour l'image
	&& !empty($_FILES['image'])

	// On vérifie qu'il n'y a pas d'erreur
	&& $_FILES['image']['error'] == 0

	// On vérifie son type (jpg ou png)
	&& ($_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpeg')

	// On vérifie qu'elle fait pas plus de 5 Mo
	&& $_FILES['image']['size'] < 5242880
) {
	$bdd = connectDB();

	$requete = 'INSERT INTO articles (titre, contenu, image, image_alt, image_copyright, date) 
							VALUE (?, ?, ?, ?, ?, ?)';

	$statement = $bdd->prepare($requete);
	$date = date('Y-m-d');			// aaaa-mm-jj

	if ($_FILES['image']['type'] == 'image/png') $ext = 'png';
	else $ext = 'jpg';

	$new_file_name = 'images/' . uniqid('article_') . '.' . $ext;

	move_uploaded_file(
		$_FILES['image']['tmp_name'], 
		$new_file_name
	);

	$statement->bindParam(1, $_POST['titre']);
	$statement->bindParam(2, $_POST['contenu']);
	$statement->bindParam(3, $new_file_name);
	$statement->bindParam(4, $_POST['image_alt']);
	$statement->bindParam(5, $_POST['image_copyright']);
	$statement->bindParam(6, $date);

	$statement->execute();

	header('location: liste-articles.php');
}

else {
	header('location: creer-article.php');
	die;
}