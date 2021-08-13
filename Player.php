<?php

class Player
{
    private $_id;
    private $_name;
    private $_experience;
    private $_power;
    private $_health;
    private $_level;

    const MAX_EXP = 10;

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

    public function name()
    {
        return $this->name;
    }

    public function experience()
    {
        return $this->_experience;
    }

    public function power()
    {
        return $this->power;
    }


    public function health()
    {
        return $this->_health;
    }

    public function level()
    {
        return $this->_level;
    }

    // Setter //

    public function setId(int $id)
    {
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }


    public function setExperience(int $experience)
    {
        if ($experience >= 0) {
            $this->_experience = $experience;
        }
    }

    public function setPower(int $power)
    {
        if ($power >= 1 && $power <= 100) {
            $this->_power = $power;
        }
    }

    public function setHealth(int $health)
    {
        if ($health < 0) {
            $health = 0;
        }

        if ($health <= 100) {
            $this->_health = $health;
        }
    }

    public function setLevel(int $level)
    {
        if ($level >= 1 && $level <= 100) {
            $this->_niveauPerso = $level;
        }
    }

    // function action //


    public function punch(Player $hitOtherPlayer)
    {

        echo $this->name() . " à frappé " . $hitOtherPlayer . " <br><br>";
        $isCritik = $this->critikStrike();
        $hitOtherPlayer->$this->sufferDamage($this->calculeteDamage($isCritik));
        $this->experienceGain();
    }

    private function sufferDamage(int $damage)
    {

        $this->setHealth($this->health - $damage);
        echo " il à perdu " . $this->health . "<br><br>";
    }

    private function calculeteDamage(bool $isCritik)
    {

        $damages = $this->level * $this->power;

        if ($isCritik) {
            $damages = $damages * rand(2, 4);
        }
    }


    private function critikStrike()
    {

        $critik = rand(1, 6);
        if ($critik == 3) {
            return true;
        } else {
            return false;
        }
    }

    private function experienceGain(int $exp = 5)
    {

        $this->setExperience($this->experience() + $exp);
        $levelGain = floor($this->experience() / self::MAX_EXP);
        $remainExp = $this->experience() % self::MAX_EXP;

        if ($this->experience >= 10) {
            $this->levelUp($levelGain, $remainExp);
        }
    }

    private function levelUp(int $levelGain, $remainExp)
    {
        $this->setLevel($this->level * $levelGain);
        echo $this->name() . " a gagné " . $levelGain . ", il lui reste " . $remainExp;
    }
}
