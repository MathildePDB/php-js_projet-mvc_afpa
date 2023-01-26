<?php

// classe enfant issue de Manager

class ArticleManager extends Manager implements InterfaceManager
{
    public function findAll($type = 'obj') {
        $articles = $this -> tableFindAll('article');
        if ($type == 'obj') {
            $objet = new Article($articles);
            return $objet;
        } else {
            return $articles;
        }
    }

    public function findOne($type = 'obj') {
        $article = $this -> tableFindOne('article');
        if ($type == 'obj') {
            $objet = new Article($article);
            return $objet;
        } else {
            return $article;
        }
    }

    public function findAllBy($conditions=[], $orders=[], $type='obj') {
        $articles = $this -> tableFindAllBy('article', $conditions, $orders);
        $objets = [];
        if ($type == 'obj') {
            foreach ($articles as $valeur) {
                $objet = new Article($valeur);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $articles;
        }
    }

    public function findById($id, $type = 'obj') {
        $article = $this -> tableFindById('article', $id);
        if ($type == 'obj') {
            $objet = new Article($article);
            return $objet;
        } else {
            return $article;
        }
    }

    public function insert($data)
    {
        $this->tableInsert('article', $data);
    }

    public function update($data, $id)
    {
        $this->tableUpdate('article', $data ,$id);
    }

    public function delete($conditions)
    {
        $this->tableDelete('article', $conditions);
    }
}
