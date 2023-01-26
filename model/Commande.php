<?php

class Commande
{
    // definition des variables accessibles uniquement ici

    private $id;
    private $numcommande;
    private $client_id;
    private $datecommande;
    private $montant;
    private $typecommande;

    // fonction construct qui permet de convertir la table en objet

    public function __construct($data = [])
    {
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
    public function getNumcommande()
    {
        return $this->numcommande;
    }
    public function setNumcommande($numcommande)
    {
        $this->numcommande = $numcommande;
        return $this;
    } 
    public function getClient_id()
    {
        return $this->client_id;
    }
    public function setClient_id($client_id)
    {
        $this->client_id = $client_id;
        return $this;
    }
    public function getDatecommande()
    {
        return $this->datecommande;
    } 
    public function setDatecommande($datecommande)
    {
        $this->datecommande = $datecommande;
        return $this;
    } 
    public function getMontant()
    {
        return $this->montant;
    }
    public function setMontant($montant)
    {
        $this->montant = $montant;
        return $this;
    } 
    public function getTypecommande()
    {
        return $this->typecommande;
    }
    public function setTypecommande($typecommande)
    {
        $this->typecommande = $typecommande;
        return $this;
    }
}
