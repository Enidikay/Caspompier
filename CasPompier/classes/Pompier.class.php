<?php
class Pompier
{
    private $_matricule;
    private $_nom;
    private $_prenom;
    private $_ddn;
    private $_tel;
    private $_sexe;
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


    // Getter pour matricule
    public function getMatricule()
    {
        return $this->_matricule;
    }

    // Setter pour matricule
    public function setMatricule($matricule)
    {
        if (is_int($matricule)) {
            $this->_matricule = $matricule;
        }
    }

    // Getter pour nom
    public function getNom()
    {
        return $this->_nom;
    }

    // Setter pour nom
    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }

    // Getter pour prenom
    public function getPrenom()
    {
        return $this->_prenom;
    }

    // Setter pour prenom
    public function setPrenom($prenom)
    {
        if (is_string($prenom)) {
            $this->_prenom = $prenom;
        }
    }

    // Getter pour ddn
    public function getDdn()
    {
        return $this->_ddn;
    }

    // Setter pour ddn
    public function setDdn($ddn)
    {
        if (is_string($ddn)) {
            $this->_ddn = $ddn;
        }
    }

    // Getter pour tel
    public function getTel()
    {
        return $this->_tel;
    }

    // Setter pour tel
    public function setTel($tel)
    {
        if (is_string($tel)) {
            $this->_tel = $tel;
        }
    }

    // Getter pour sexe
    public function getSexe()
    {
        return $this->_sexe;
    }

    // Setter pour sexe
    public function setSexe($sexe)
    {
        if (is_string($sexe)) {
            $this->_sexe = $sexe;
        }
    }

    // Getter pour id
    public function getId()
    {
        return $this->_id;
    }

    // Setter pour id
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

}
