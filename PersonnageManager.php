<?php

require 'Personnage.php';

class PersonnageManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    //public function add(Personnage $perso)
    //{
    //$q = $this->_db->prepare('INSERT INTO individu (nom, forcePerso, degats, experience) VALUES(:nom, :forcePerso, :degats, :experience)');

    //$q->bindValue(':nom', $perso->nom());
    //$q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    //$q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    //$q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);

    //$q->execute();
    //}
    //public function delete(Personnage $perso)
    //{
    //$this->_db->exec('DELETE FROM individu WHERE id = ' . $perso->id());
    //}

    public function get(int $id)
    {

        $q = $this->_db->query('SELECT id, nom, forcePerso, experience, pointDeVie FROM individu WHERE id = ' . $id);
        $donnees = $q->fetch();

        return new Personnage($donnees);
    }

    public function getList($nom)
    {
        $persos = [];

        $q = $this->_db->query('SELECT id, nom, forcePerso, niveau, experience, pointDeVie FROM personnages ORDER BY nom');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new Personnage($donnees);
        }

        return $persos;
    }

    public function update(Personnage $perso)
    {
        $q = $this->_db->prepare('UPDATE individu SET forcePerso = :forcePerso, experience = :experience, pointDeVie = :pointDeVie WHERE id = :id');

        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        $q->bindValue(':pointDeVie', $perso->pointDeVie(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
