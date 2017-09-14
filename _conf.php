<?php
return array(
  "title" => 'Manuels scolaires', // Nom du corpus
  "srcdir" => dirname( __FILE__ ), // dossier source depuis lequel exécuter la commande de mise à jour
  "cmdup" => "git pull 2>&1", // commande de mise à jour
  "pass" => "", // Mot de passe à renseigner obligatoirement à l’installation
  "srcglob" => array( "manuels/*.xml" ), // sources XML à publier
  "sqlite" => "manuels.sqlite", // nom de la base avec les métadonnées
  "back" => "//obvil.paris-sorbonne.fr/projets/lecrivain-linstitution-scolaire-et-la-litterature-lecrivain-face-aux-modeles-scolaires-1840",
);
?>
