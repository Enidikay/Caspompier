<?php
class GradeManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }


    public function dynagrade()
    {
        $query = 'SELECT id,libellé FROM grade';
        $q = $this->_db->prepare($query);
        if ($q->execute()) {
            $result = $q->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function getGradeById($id)
    {
        $query = 'SELECT libellé FROM grade WHERE id = :id';
        $q = $this->_db->prepare($query);
        $q->bindValue(':id', $id);

        if ($q->execute()) {
            $result = $q->fetch(PDO::FETCH_ASSOC);
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
