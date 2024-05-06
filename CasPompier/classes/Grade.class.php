<?php
class Grade
{
    private $id; // attribut pour stocker l'identifiant du grade
    private $libele; // attribut pour stocker le libellé du grade

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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLibele()
    {
        return $this->libele;
    }

    public function setLibele($libele)
    {
        $this->libele = $libele;
    }
}
