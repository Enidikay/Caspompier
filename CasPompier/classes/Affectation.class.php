<?php
class Affectation
{
    private $_date;
    private $_matricule;
    private $_id;

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

    // Getter pour la date
    public function getDate()
    {
        return $this->_date;
    }

    // Setter pour la date
    public function setDate($date)
    {
        $this->_date = $date;
    }

    // Getter pour le matricule
    public function getMatricule()
    {
        return $this->_matricule;
    }

    // Setter pour le matricule
    public function setMatricule($matricule)
    {
        $this->_matricule = $matricule;
    }

    // Getter pour l'ID
    public function getId()
    {
        return $this->_id;
    }

    // Setter pour l'ID
    public function setId($id)
    {
        $this->_id = $id;
    }
}
?>