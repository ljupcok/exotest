<?php

require 'Player.php';

class PersonnageManager
{
    const TABLE_NAME = "Player";
    const TABLE_CHAMPS = "id, name, experience, power, health, level";
    const TABLE_OBJECT = "Player";

    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function get(int $id)
    {

        $q = $this->_db->query('SELECT ' . self::TABLE_CHAMPS . ' FROM ' . self::TABLE_NAME . ' WHERE id = ' . $id);
        $data = $q->fetch();

        return new Player($data);
        //return $q->fetchObject(self::TABLE_OBJECT);

    }

    public function getList($nom)
    {
        $persos = [];

        $q = $this->_db->query('SELECT ' . self::TABLE_CHAMPS . ' FROM ' . self::TABLE_NAME . ' ORDER BY name');

        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new Player($data);
        }

        return $persos;
    }

    public function update(Player $perso)
    {
        $q = $this->_db->prepare('UPDATE ' . self::TABLE_NAME . ' SET power = :power, experience = :experience, health = :health, level = :level WHERE id = :id');

        $q->bindValue(':power', $perso->power(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        $q->bindValue(':health', $perso->health(), PDO::PARAM_INT);
        $q->bindValue(':level', $perso->level(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
