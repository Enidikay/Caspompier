<?php
class TypeEngin
{
    private $_id;
    private $_libelle;
    private $_image;

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

    // Getter pour le libellé
    public function getLibelle()
    {
        return $this->_libelle;
    }

    // Setter pour le libellé
    public function setLibelle($libelle)
    {
        $this->_libelle = $libelle;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function setImage($image)
    {
        $this->_image = $image;
    }

}