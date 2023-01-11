<?php 

ob_start() 

?>

<table class="table text-center">
    <thead>
        <tr class="table-dark">
            <th>Image</th>
            <th>Titre</th>
            <th>Nombre de pages</th>
            <!-- colspan : permet de divier la cellule :)  -->
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($livres as $livre) : ?>
        <tr>
            <td><img src="public/images/<?= $livre->getImage(); ?>" width="60px"></td>
            <td class="align-middle"><a href="<?= URL ?>livres/l/<?= $livre->getId() ?>"><?= $livre->getTitre() ?></a></td>
            <td class="align-middle"><?= $livre->getNbPages() ?></td>
            <td class="align-middle"><a class="btn btn-warning" href="<?= URL ?>livres/m/">Modifier</a></td>
            <td class="align-middle">
                <form method="POST" action="<?= URL ?>livres/s/<?= $livre->getId(); ?>" onSubmit="return confirm('Voulez vous vraiment supprimer ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
            </td
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a class="btn btn-success d-block" href="<?= URL ?>livres/a">Ajouter</a>
<?php 
$titre = "Les livres de la bibliothèque";
$content = ob_get_clean();
require "template.php";


?>