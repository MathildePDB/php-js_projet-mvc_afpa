<?php

class Client
{
    // definition des variables accessibles uniquement ici

    private $id;
    private $numclient;
    private $nomclient;
    private $adresseclient;
    private $telephoneclient;
    private $typeclient;

    // // fonction construct qui permet de convertir la table en objet

    public function __construct($data = [])
    {
        // echo "<h2> Vous êtes en php objet dans la class client</h2>";
        if ($data) {
            foreach ($data as $key => $value) {
                $set = 'set' . ucfirst($key);
                if (method_exists($this, $set)) {
                    $this->$set($value);
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
    public function getNumclient()
    {
        return $this->numclient;
    }
    public function setNumclient($numclient)
    {
        $this->numclient = $numclient;
        return $this;
    } 
    public function getNomclient()
    {
        return $this->nomclient;
    }
    public function setNomclient($nomclient)
    {
        $this->nomclient = $nomclient;
        return $this;
    } 
    public function getAdresseclient()
    {
        return $this->adresseclient;
    } 
    public function setAdresseclient($adresseclient)
    {
        $this->adresseclient = $adresseclient;
        return $this;
    } 
    public function getTelephoneclient()
    {
        return $this->telephoneclient;
    } 
    public function setTelephoneclient($telephoneclient)
    {
        $this->telephoneclient = $telephoneclient;
        return $this;
    }
    public function getTypeclient()
    {
        return $this->typeclient;
    } 
    public function setTypeclient($typeclient)
    {
        $this->typeclient = $typeclient;
        return $this;
    }
}
