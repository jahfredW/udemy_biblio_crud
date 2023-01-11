<?php ob_start() ?>

<div class="container">
    <!-- attention si file alors mettre multipart/form-data -->
    <form class="form" method="POST" action="<?= URL ?>livres/av" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="titre">Titre</label>
            <input id="titre" name="titre" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="nbPages">Nombre de Pages</label>
            <input id="nbPages" name="nbPages" type="number" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input id="image" name="image" type="file" class="form-control-file">
        </div>
        <input type="submit" class="btn btn-primary mt-2">

    </form>
</div>

<?php 
$titre = "Ajout d'un livre";
$content = ob_get_clean();
require "template.php"; ?>