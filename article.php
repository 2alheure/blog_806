<?php
include_once 'fonctions/fonctions_bdd.php';

// http://localhost/......../article.php?id=[id]

if (!empty($_GET['id'])) {

	$article = getArticle($_GET['id']);

	if ($article == false) {
		include_once '404.php';
		die;
	}

	$titre = $article['titre'] . ' | Mon super Blog';

	include_once './layout/header.php';
?>


	<img src="<?php echo $article['image']; ?>" alt="<?php echo $article['image_alt']; ?>" class="banner" />

	<small><?php echo $article['image_copyright']; ?></small>

	<h1 class="mb-4"><?php echo $article['titre']; ?></h1>

	<p><?php echo $article['contenu']; ?></p>

<?php include_once 'layout/footer.php';

} else {
	include_once '404.php';
	die;
}
