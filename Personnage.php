<?php
//require 'Connexion.php';
//$request = $db->query('SELECT id, nom, forcePerso, degats, experience FROM individu');
//$donnees = $request->fetch(PDO::FETCH_ASSOC));


class Personnage
{
    private $_id;
    private $_nom;
    private $_degats;
    private $_experience;
    private $_force;
    private $_pointDeVie;



    // public function __construct($force, $degats, $pointDeVie)
    //{
    //$this->setForce($force);
    //$this->setDegats($degats);
    //$this->setPointDeVie($pointDeVie);
    //$this->_experience = 1;
    //}

    public function hydrate(array $donnees)
    {
        if (isset($donnees['id'])) {
            $this->setId = $donnees['id'];
        }
        if (isset($donnees['nom'])) {
            $this->setNom = $donnees['nom'];
        }
        if (isset($donnees['degats'])) {
            $this->setDegats = $donnees['degats'];
        }
        if (isset($donnees['experience'])) {
            $this->setExperience = $donnees['experience'];
        }
        if (isset($donnees['force'])) {
            $this->setForce = $donnees['force'];
        }
        if (isset($donnees['pointDeVie'])) {
            $this->setPointDeVie = $donnees['pointDeVie'];
        }
    }

    // Getter //
    public function id()
    {
        return $this->_id;
    }

    public function nom()
    {
        return $this->_nom;
    }
    function degats()
    {
        return $this->_degats;
    }
    function pointDeVie()
    {
        return $this->_pointDeVie;
    }
    function force()
    {
        return $this->_force;
    }
    function experience()
    {
        return $this->_experience;
    }


    // Setter //

    public function setId(int $id)
    {

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }

    public function setForce(int $force)
    {

        if ($force >= 1 && $force <= 100) {
            $this->_force = $force;
        }
    }

    public function setDegats(int $degats)
    {
        if ($degats >= 1 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

    public function setPointDeVie(int $pointDeVie)
    {

        if ($pointDeVie >= 1 && $pointDeVie <= 100) {
            $this->_pointDeVie = $pointDeVie;
        }
    }

    public function setExperience(int $experience)
    {

        if ($experience >= 1 && $experience <= 100) {
            $this->_experience = $experience;
        }
    }

    // méthode d'action //

    function frapper(Personnage $persoAFrapper)
    {
        $persoAFrapper->_degats += $this->_force;
    }

    function gagnerExperience()
    {
        $this->_experience = $this->_experience + 1; //$this->_experience++//
    }

    function perteVie()
    {
    }
}
