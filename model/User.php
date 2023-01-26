<?php
class User
{
    // definition des variables accessibles uniquement ici

    private $id;
    private $username;
    private $email;
    private $password;
    private $roles;
    private $dateconnexion;
    private $groupeuser_id;

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
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    } 
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
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
    public function getDateconnexion()
    {
        return $this->dateconnexion;
    }
    public function setDateconnexion($dateconnexion)
    {
        $this->dateconnexion = $dateconnexion;
        return $this;
    }
    public function getGroupeuser_id()
    {
        return $this->groupeuser_id;
    }
    public function setGroupeuser_id($groupeuser_id)
    {
        $this->groupeuser_id = $groupeuser_id;
        return $this;
    }
    public function getGrouperoles() {
        $m = new Manager;
        $groupeuser_id = $this->groupeuser_id;
        $groupeuser=$m->tableFindById('groupeuser', $groupeuser_id);
        // si groupeuserManager -> findById($groupeuser_id)
        if ($groupeuser) {
            $roles = $groupeuser['roles'];
            $roles = json_decode($roles);
        } else {
            $roles = ['ROLE_USER'];
        }
        return $roles;
    }
    
    public function getLibelleGroupe(){
        $m=new Manager();
        $groupeuser_id=$this->groupeuser_id;
        $groupeuser=$m->tableFindById('groupeuser',$groupeuser_id);
        if($groupeuser){
            $libelle=$groupeuser['libelle'];
        }else{
            $libelle=['VISITEUR'];
        }
        return $libelle;
    }
}
