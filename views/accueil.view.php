<?php ob_start() ?>

<p>Ma page d'accueil</p>

<?php 
$titre = "Bibliothèque";
$content = ob_get_clean();
require "template.php";

?>