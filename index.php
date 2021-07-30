<?php
require 'Connexion.php';
require 'PersonnageManager.php';

//require 'Connexion'; 
//$request = $db->query('SELECT id, nom, forcePerso, degats, experience FROM individu');
//while ($donnes = $request->fetch(PDO::FETCH_ASSOC))
//{
//  $perso = new Personnage($donnees)
//}
$Connexion = new Connexion();
$PersonnageManager = new PersonnageManager($Connexion->dbConnect());

$perso1 = $PersonnageManager->get(1);
$perso2 = $PersonnageManager->get(2);


$perso1->frapper($perso2);
$perso1->gagnerExperience();
$perso1->AfficherExperience();
