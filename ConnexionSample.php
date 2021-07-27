<?php

class Connexion
{
    private $_dbHost = '';
    private $_dbName = '';
    private $_dbUserName = '';
    private $_dbUserPassWord = '';

    protected function dbConnect()
    {
        $db = new PDO(
            'mysql:host=' . $this->_dbHost . ';dbname=' . $this->_dbName . ';charset=utf8',
            $this->_dbUserName,
            $this->_dbUserPassWord
        );
        return $db;
    }
}
