<?php
//require 'Connexion.php';
//$request = $db->query('SELECT id, nom, forcePerso, degats, experience FROM individu');
//$donnees = $request->fetch(PDO::FETCH_ASSOC));

class Personnage
{
    private $_id;
    private $_nom;
    private $_experience;
    private $_forcePerso;
    private $_pointDeVie;

    const LEVEL_UP = 10;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    // public function __construct($forcePerso, $degats, $pointDeVie)
    //{
    //$this->setForcePerso($forcePerso);
    //$this->setDegats($degats);
    //$this->setPointDeVie($pointDeVie);
    //$this->_experience = 1;
    //}

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
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

    public function forcePerso()
    {
        return $this->_forcePerso;
    }

    public function experience()
    {
        return $this->_experience;
    }

    public function pointDeVie()
    {
        return $this->_pointDeVie;
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

    public function setForcePerso(int $forcePerso)
    {
        if ($forcePerso >= 1 && $forcePerso <= 100) {
            $this->_forcePerso = $forcePerso;
        }
    }

    public function setExperience(int $experience)
    {
        if ($experience >= 1 && $experience <= 10) {
            $this->_experience = $experience;
        }
    }

    public function setPointDeVie(int $pointDeVie)
    {
        if ($pointDeVie >= 1 && $pointDeVie <= 100) {
            $this->_pointDeVie = $pointDeVie;
        }
    }

    // méthode d'action //

    public function frapper(Personnage $persoAFrapper)
    {
        $persoAFrapper->setPointDeVie($persoAFrapper->pointDeVie() - $this->forcePerso());
        echo $this->nom() . " a frapper " . $persoAFrapper->nom() . "<br><br>";
        $persoAFrapper->AfficherPerteVie($this->forcePerso());
        $this->nom()->setExperience();
        $this->nom()->AfficherExperience();
        //var_dump($persoAFrapper);
    }

    public function AfficherPerteVie(int $quantite)
    {
        echo "Le joueur " . $this->nom() . " à perdu " . $quantite . " point de vie <br><br>";
        echo "il lui reste " . $this->pointDeVie() . "<br><br>";
    }

    public function gagnerExperience()
    {
        $this->_experience = $this->_experience + 1; //$this->_experience++//
    }

    public function AfficherExperience(int $experience)
    {
        echo "le joueur " . $this->nom() . " à gagné " . $this->_experience . " d'expérience durant ce combat";
    }

    //public function levelUp()
    //{
    //  if($experience >= 10)
    //   {

    //   }

    //}



}
