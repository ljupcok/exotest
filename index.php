<?php
require 'Connexion.php';
require 'PersonnageManager.php';

$Connexion = new Connexion();
$PersonnageManager = new PersonnageManager($Connexion->dbConnect());

$perso1 = $PersonnageManager->get(1);
$perso2 = $PersonnageManager->get(2);


$perso1->punch($perso2);
$perso1->punch($perso2);
$perso1->punch($perso2);
$perso1->punch($perso2);
$perso1->punch($perso2);
$perso1->punch($perso2);
$perso1->punch($perso2);
$perso1->punch($perso2);


//$perso1->CoupCritique();
