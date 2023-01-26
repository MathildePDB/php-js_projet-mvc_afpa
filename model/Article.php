<?php
class Article
{
    // definition des variables accessibles uniquement ici

    private $id;
    private $numarticle;
    private $designation;
    private $prixunitaire;
    private $prixrevient;
    private $photo;

    // fonction construct qui permet de convertir la table en objet

    public function __construct($data = [])
    {
        if ($data) {
            foreach ($data as $indice => $valeur) {
                $set = 'set' . ucfirst($indice);
                if (method_exists($this, $set)) {
                    $this->$set($valeur);
                }
            }
        }
    }

    // fonctions qui permettent de récupérer et de convertir les différentes valeurs de la table

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getNumarticle()
    {
        return $this->numarticle;
    }
    public function setNumarticle($numarticle)
    {
        $this->numarticle = $numarticle;
        return $this;
    }
    public function getDesignation()
    {
        return $this->designation;
    }
    public function setDesignation($designation)
    {
        $this->designation = $designation;
        return $this;
    }
    public function getPrixunitaire()
    {
        return $this->prixunitaire;
    }
    public function setPrixunitaire($prixunitaire)
    {
        $this->prixunitaire = $prixunitaire;
        return $this;
    }
    public function getPrixrevient()
    {
        return $this->prixrevient;
    }
    public function setPrixrevient($prixrevient)
    {
        $this->prixrevient = $prixrevient;
        return $this;
    }
    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }
}
