<?php
class Role {
    private $id;
    private $libelle;
    private $roles;

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
    public function getLibelle()
    {
        return $this->libelle;
    }
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    } 
    public function getRoles()
    {
        return $this->roles;
    }
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }
}