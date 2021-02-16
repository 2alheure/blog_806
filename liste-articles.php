<?php
$titre = 'Mes supers articles | Mon super Blog';
include_once 'layout/header.php'; ?>

<h1>Mes super articles</h1>
<div class="list-group my-4">


    <?php
    include_once 'fonctions/fonctions_bdd.php';

    $variable_article = getArticle();


    foreach ($variable_article as $article) {
        affichage($article);
    }

    ?>


</div>

<?php include_once 'layout/footer.php'; ?>