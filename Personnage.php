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
    private $_niveauPerso;

    const LEVEL_UP = 10;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

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

    public function niveauPerso()
    {
        return $this->_niveauPerso;
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

    public function setNiveauPerso(int $niveauPerso)
    {
        if ($niveauPerso >= 1 && $niveauPerso <= 100) {
            $this->_niveauPerso = $niveauPerso;
        }
    }
    // méthode d'action //

    public function frapper(Personnage $persoAFrapper)
    {
        $persoAFrapper->setPointDeVie($persoAFrapper->pointDeVie() - $this->forcePerso());
        echo $this->nom() . " a frapper " . $persoAFrapper->nom() . "<br><br>";
        $persoAFrapper->AfficherPerteVie($this->forcePerso());
        $this->gagnerExperience();
    }

    public function gagnerExperience(int $qtt = 4)
    {
        $this->setExperience($this->experience() + $qtt);
        $this->AfficherExperience($qtt);
        if ($this->experience() >= 10) {
            $this->levelUp();
        }
    }

    public function AfficherPerteVie(int $quantite)
    {
        echo "Le joueur " . $this->nom() . " à perdu " . $quantite . " point de vie <br><br>";
        echo "il lui reste " . $this->pointDeVie() . "<br><br>";
    }

    public function AfficherExperience(int $exp)
    {
        echo "le joueur " . $this->nom() . " à gagné " . $exp . " d'expérience durant ce combat <br><br>";
    }

    public function levelUp()
    {
        $this->setNiveauPerso($this->niveauPerso() + 1);
        $this->setPointDeVie(100);
        $this->setExperience(0);
        echo $this->nom() . "à gagné " . $this->niveauPerso() . "<br><br>";
    }
}
