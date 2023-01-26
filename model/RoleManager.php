<?php

class RoleManager extends Manager implements InterfaceManager
{

    public function findAll($type = 'obj')
    {
        $roles = $this->tableFindAll('role');
        $objets = [];
        if ($type == 'obj') {
            foreach ($roles as $role) {
                $objet = new Role($role);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $roles;
        }
    }

    public function findOne($type = 'obj')
    {
        $role = $this->tableFindOne('role');
        if ($type == 'obj') {
            $objet = new Role($role);
            return $objet;
        } else {
            return $role;
        }
    }

    public function findAllBy($conditions = [], $orders = [], $type = 'obj')
    {
        $roles = $this->tableFindAllBy('role', $conditions, $orders);
        $objets = [];
        if ($type == 'obj') {
            foreach ($roles as $valeur) {
                $objet = new Role($valeur);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $roles;
        }
    }

    public function findById($id, $type = 'obj')
    {
        $role = $this->tableFindById('role', $id);
        if ($type == 'obj') {
            $objet = new Role($role);
            return $objet;
        } else {
            return $role;
        }
    }

    public function findOneBy($conditions=[],$orders=[],$type='obj'){
        $role=$this->tableFindOneBy('role',$conditions,$orders);
        if($type=='obj'){
             $objet=new Role($role);
             return $objet;
        }else{
            return $role;
        }
    }

    public function insert($data)
    {
        $this->tableInsert('role', $data);
    }

    public function update($data, $conditions)
    {
        $this->tableUpdate('role',$data,$conditions);
    }

    public function delete($conditions)
    {
        $this->tableDelete('role',$conditions);
    }
}
