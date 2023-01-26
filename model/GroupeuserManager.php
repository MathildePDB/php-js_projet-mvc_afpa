<?php

class GroupeuserManager extends Manager implements InterfaceManager
{

    public function findAll($type = 'obj')
    {
        $groupeusers = $this->tableFindAll('groupeuser');
        $objets = [];
        if ($type == 'obj') {
            foreach ($groupeusers as $groupeuser) {
                $objet = new Groupeuser($groupeuser);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $groupeusers;
        }
    }

    public function findOne($type = 'obj')
    {
        $groupeuser = $this->tableFindOne('groupeuser');
        if ($type == 'obj') {
            $objet = new Groupeuser($groupeuser);
            return $objet;
        } else {
            return $groupeuser;
        }
    }

    public function findAllBy($conditions = [], $orders = [], $type = 'obj')
    {
        $groupeusers = $this->tableFindAllBy('groupeuser', $conditions, $orders);
        $objets = [];
        if ($type == 'obj') {
            foreach ($groupeusers as $valeur) {
                $objet = new Groupeuser($valeur);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $groupeusers;
        }
    }

    public function findById($id, $type = 'obj')
    {
        $groupeuser = $this->tableFindById('groupeuser', $id);
        if ($type == 'obj') {
            $objet = new Groupeuser($groupeuser);
            return $objet;
        } else {
            return $groupeuser;
        }
    }

    public function findOneBy($conditions = [], $orders = [], $type = 'obj')
    {
        $groupeuser = $this->tableFindOneBy('groupeuser', $conditions, $orders);
        if ($type == 'obj') {
            $objet = new Groupeuser($groupeuser);
            return $objet;
        } else {
            return $groupeuser;
        }
    }

    public function insert($data)
    {
        $this->tableInsert('groupeuser', $data);
    }

    public function update($data, $conditions)
    {
        $this->tableUpdate('groupeuser', $data, $conditions);
    }

    public function delete($conditions)
    {
        $this->tableDelete('groupeuser', $conditions);
    }
}
