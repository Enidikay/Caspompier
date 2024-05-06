<?php
class Engin
{
    private $_numero;
    private $_caserneid;
    private $_typeenginid;

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

    // Getter pour la propriété $_numero
    public function getNumero()
    {
        return $this->_numero;
    }

    // Setter pour la propriété $_numero
    public function setNumero($numero)
    {
        $this->_numero = $numero;
    }

    // Getter pour la propriété $_caserneid
    public function getCaserneid()
    {
        return $this->_caserneid;
    }

    // Setter pour la propriété $_caserneid
    public function setCaserneid($caserneid)
    {
        $this->_caserneid = $caserneid;
    }

    // Getter pour la propriété $_typeenginid
    public function getTypeenginid()
    {
        return $this->_typeenginid;
    }

    // Setter pour la propriété $_typeenginid
    public function setTypeenginid($typeenginid)
    {
        $this->_typeenginid = $typeenginid;
    }
}
?>