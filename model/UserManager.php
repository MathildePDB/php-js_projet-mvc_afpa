<?php

class UserManager extends Manager implements InterfaceManager
{

    public function findAll($type = 'obj')
    {
        $users = $this->tableFindAll('users');
        $objets = [];
        if ($type == 'obj') {
            foreach ($users as $user) {
                $objet = new User($user);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $users;
        }
    }

    public function findOne($type = 'obj')
    {
        $user = $this->tableFindOne('users');
        if ($type == 'obj') {
            $objet = new User($user);
            return $objet;
        } else {
            return $user;
        }
    }

    public function findAllBy($conditions = [], $orders = [], $type = 'obj')
    {
        $users = $this->tableFindAllBy('users', $conditions, $orders);
        $objets = [];
        if ($type == 'obj') {
            foreach ($users as $valeur) {
                $objet = new User($valeur);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $users;
        }
    }

    public function findById($id, $type = 'obj')
    {
        $user = $this->tableFindById('users', $id);
        if ($type == 'obj') {
            $objet = new User($user);
            return $objet;
        } else {
            return $user;
        }
    }

    public function findOneBy($conditions=[],$orders=[],$type='obj'){
        $user=$this->tableFindOneBy('users',$conditions,$orders);
        if($type=='obj'){
             $objet=new User($user);
             return $objet;
        }else{
            return $user;
        }
    }

    public function insert($data)
    {
        $this->tableInsert('users', $data);
    }

    public function update($data, $conditions)
    {
        $this->tableUpdate('users',$data,$conditions);
    }

    public function delete($conditions)
    {
        $this->tableDelete('users',$conditions);
    }
}
