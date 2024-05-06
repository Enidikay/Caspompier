<?php
class AdminManager
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function getAllAdmins()
    {
        // Préparation et exécution de la requête SQL
        $stmt = $this->_db->query('SELECT * FROM admin');
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Création d'un tableau d'objets Admin à partir des données récupérées
        $adminObjects = [];
        foreach ($admins as $adminData) {
            $adminObjects[] = new Admin($adminData);
        }

        return $adminObjects;
    }
    
}


?>