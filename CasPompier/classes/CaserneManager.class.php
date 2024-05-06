<?php
class CaserneManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }


    public function dynacase()
    {
        $query = 'SELECT * FROM caserne';
        $q = $this->_db->prepare($query);
        if ($q->execute()) {
            $result = $q->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }


    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }




}

