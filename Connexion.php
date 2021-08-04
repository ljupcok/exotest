<?php

class Connexion
{
    public function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=testPerso;charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

        return $db;
    }
}
