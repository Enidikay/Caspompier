<?php
class Caserne
{
    private $_id; // attribut pour stocker l'identifiant de la caserne
    private $_nom; // attribut pour stocker le nom de la caserne
    private $_image;
    private $_description;

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
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setImage($image)
    {
        $this->_image = $image;
    }

    public function getImage()
    {
        return $this->_image;
    }
    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

}

?>