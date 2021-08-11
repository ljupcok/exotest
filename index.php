<?php
require 'Connexion.php';
require 'PersonnageManager.php';

$Connexion = new Connexion();
$PersonnageManager = new PersonnageManager($Connexion->dbConnect());

$perso1 = $PersonnageManager->get(1);
$perso2 = $PersonnageManager->get(3);


$perso1->frapper($perso2);
$perso1->frapper($perso2);
<<<<<<< Updated upstream
$perso1->frapper($perso2);
=======
>>>>>>> Stashed changes
$perso1->frapper($perso2);
$perso1->frapper($perso2);
$perso1->frapper($perso2);
$perso1->frapper($perso2);
$perso1->frapper($perso2);
$perso1->frapper($perso2);
<<<<<<< Updated upstream
$perso1->frapper($perso2);
$perso1->frapper($perso2);
$perso1->frapper($perso2);
=======

>>>>>>> Stashed changes


//$perso1->CoupCritique();
