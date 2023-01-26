<?php
class Accueil
{
    private $id;
    private $numcommande;
    private $typecommande;
    private $datecommande;
    private $client_id;
    private $nomclient;
    private $montant;

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
    public function getTypecommande()
    {
        return $this->typecommande;
    }
    public function setTypecommande($typecommande)
    {
        $this->typecommande = $typecommande;
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
    public function getClient_id()
    {
        return $this->client_id;
    } 
    public function setClient_id($client_id)
    {
        $this->client_id = $client_id;
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
    public function getMontant()
    {
        return $this->montant;
    }
    public function setMontant($montant)
    {
        $this->montant = $montant;
        return $this;
    }
}