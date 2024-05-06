<?php
class Volontaire
{
    private $_matricule;
    private $_id;
    private $_bip;

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

    public function getMatricule()
    {
        return $this->_matricule;
    }

    public function setMatricule($matricule)
    {
        $this->_matricule = $matricule;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getBip()
    {
        return $this->_bip;
    }

    public function setBip($bip)
    {
        $this->_bip = $bip;
    }
}
