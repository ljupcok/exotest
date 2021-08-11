<?php

class Personnage
{
    private $_id;
    private $_nom;
    private $_experience;
    private $_forcePerso;
    private $_pointDeVie;
    private $_niveauPerso;

    const MAX_EXPERIENCE = 10;

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
        if ($experience >= 0) {
            $this->_experience = $experience;
        }
    }

    public function setPointDeVie(int $pointDeVie)
    {
        if ($pointDeVie < 0) {
            $pointDeVie = 0;
        }

        if ($pointDeVie <= 100) {
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
        echo $this->nom() . " a frapper " . $persoAFrapper->nom() . "<br><br>";
        $isCoupCritique = $this->coupCritique();
        $persoAFrapper->subirDegats($this->calculeDegatsInfliger($isCoupCritique));
        $this->gagnerExperience($isCoupCritique);
    }

    private function calculeDegatsInfliger(bool $isCoupCritique)
    {
        $degats = $this->niveauPerso() * $this->forcePerso();
        if ($isCoupCritique) {
            $degats = $degats * 2;
        }
        return $degats;
    }

    private function mourrir()
    {
        echo  $this->nom() . ' est mort <br><br>';
        // DELETE FROM `individu` WHERE id = ? ;
    }

    private function coupCritique()
    {
        if ($this->chiffreAleatoire() == 3) {
            return true;
        } else {
            return false;
        }
    }


    private function chiffreAleatoire($longueur = 1)
    {
        $chiffre = '12345';
        $longueurMax = strlen($chiffre);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++) {
            $chaineAleatoire = $chiffre[rand(0, $longueurMax - 1)];
        }
        return $chaineAleatoire;
    }

    private function gagnerExperience(bool $isCoupCritique, int $qtt = 5)
    {
        if ($isCoupCritique) {
            $qtt = $qtt * rand(2, 5);
        }

        $this->setExperience($this->experience() + $qtt); // attibut
        $niveauGagner = floor($this->experience() / self::MAX_EXPERIENCE);
        $experienceRestant = $this->experience() % self::MAX_EXPERIENCE;
        $this->AfficherExperience($qtt);

        if ($this->experience() >= self::MAX_EXPERIENCE) {
            $this->levelUp($niveauGagner, $experienceRestant);
        }
    }

    private function AfficherPerteVie(int $quantite)
    {
        echo "Il lui reste " . $this->pointDeVie() . " de PV. <br><br>";
    }

    private function AfficherExperience(int $exp)
    {
        echo "le joueur " . $this->nom() . " à gagné " . $exp . " d'expérience durant ce combat <br><br>";
    }

    private function levelUp(int $niveauGagner, $experienceRestant)
    {
        $this->setNiveauPerso($this->niveauPerso() + $niveauGagner);
        $this->setPointDeVie(100);
        $this->setExperience($experienceRestant);
        echo $this->nom() . " à gagné " . $niveauGagner . " niveau , il est level " . $this->niveauPerso() . ".<br><br>";
    }

    private function subirDegats(int $degats)
    {
        $this->setPointDeVie($this->pointDeVie() - $degats);
        $this->AfficherPerteVie($degats);

        if ($this->pointDeVie() <= 0) {
            $this->mourrir();
        }
    }
}
