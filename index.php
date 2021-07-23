<?php
require 'Personnage.php';
//require 'Connexion';


//$request = $db->query('SELECT id, nom, forcePerso, degats, experience FROM individu');



$perso1 = new Personnage();
$perso2 = new Personnage();

$perso1->setForce(4);
//$perso1->setExperience(3);
//$perso2->setForce(2);
//$perso2->setExperience(5);

//$perso1->frapper($perso2);
//$perso1->gagnerExperience();

//$perso2->frapper($perso1);
//$perso2->gagnerExperience();

echo $perso1->force();
