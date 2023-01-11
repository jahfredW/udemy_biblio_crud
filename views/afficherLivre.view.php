<?php ob_start();

?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <img src="<?= URL ?>public/images/<?= $livre->getImage(); ?>" alt="couverture du livre">
        </div>
        <div class="col-6">
            <p>Titre : <?= $livre->getTitre(); ?></p>
            <p>Nombre de Pages: <?= $livre->getNbPages(); ?></p>
        </div>
    </div>
</div>


<?php 

$titre = $livre->getTitre();
$content = ob_get_clean();
require "template.php";
?>