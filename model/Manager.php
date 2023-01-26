<?php

class Manager extends Database
{
    

    public function tableFindAll($table)
    {
        $connexion = $this->connexion();
        $sql = "select * from $table";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $resultats = $stmt->fetchAll();
        return $resultats;
    }

    public function tableFindOne($table, $type = 'obj')
    {
        if ($type == 'obj') {
            $connexion = $this->connexion();
            $sql = "select * from $table";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $resultat = $stmt->fetch();
            return $resultat;
        }
    }

    public function tableFindById($table, $id)
    {
        $connexion = $this->connexion();
        $sql = "select * from $table where id=?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$id]);
        $resultat = $stmt->fetch();
        return $resultat;
    }

    public function tableFindAllBy($table, $conditions = [], $orders = [])
    {
        $valeurs = [];
        $condition = '';
        $order = '';
        if ($conditions) {
            $condition = 'where';
            foreach ($conditions as $indice => $valeur) {
                $condition .= ($condition == 'where') ? " $indice=?" : " and $indice=?";
                $valeurs[] = $valeur;
            }
        } else {
            $condition = '';
        }

        if ($orders) {
            $order = 'order by';
            foreach ($orders as $indice => $valeur) {
                $order .= ($order == 'order by') ? " $indice $valeur" : " ,$indice $valeur";
            }
        }
        $sql = "select * from $table $condition $order";
        $stmt = $this->connexion()->prepare($sql);
        $stmt->execute($valeurs);
        $resultat = $stmt->fetchAll();
        return $resultat;
    }

    public function tableFindAllByLimit($table, $conditions, $orders, $limit)
    {
        $valeurs = [];
        $condition = '';
        $order = '';
        if ($conditions) {
            $condition = 'where';
            foreach ($conditions as $indice => $valeur) {
                $condition .= ($condition == 'where') ? " $indice=?" : " and $indice=?";
                $valeurs[] = $valeur;
            }
        } else {
            $condition = '';
        }

        if ($orders) {
            $order = 'order by';
            foreach ($orders as $indice => $valeur) {
                $order .= ($order == 'order by') ? " $indice $valeur" : " ,$indice $valeur";
            }
        }
        if ($limit) {
            $lim = 'limit';
            $lim .= ($lim == 'limit') ? " $limit" : "";
        }
        $sql = "select * from $table $condition $order $lim";
        $stmt = $this->connexion()->prepare($sql);
        $stmt->execute($valeurs);
        $resultat = $stmt->fetchAll();
        return $resultat;
    }

    public function tableFindAllById($table, $id, $type = 'obj')
    {
        if ($type == 'obj') {
            $connexion = $this->connexion();
            $sql = "select * from $table where id=?";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$id]);
            $resultat = $stmt->fetchAll();
            return $resultat;
        }
    }

    public function tableInsertData($table, $datas = [])
    {
        if ($datas) {
            $data = ' values';
            foreach ($datas as $indice => $valeur) {
                $data .= ($data == 'values ') ? '($indice) $table ($valeur)' : '';
            }
        } else {
            $data = "";
        }
        $connexion = $this->connexion();
        $sql = "insert into $table $indice $valeur";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
    }

    public function tableUpdateData($table, $datas = [], $condition = '')
    {
        $condition = ($condition) ? "where $condition" : "";
        $connexion = $this->connexion();
        $sql = "update $table set $datas $condition";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
    }

    public function tableInsert($table, $data)
    {
        $connexion = $this->connexion();
        $colonne = "";
        $value = "";
        $valeurs = [];
        foreach ($data as $indice => $valeur) {
            if ($indice != 'id') {
                $colonne .= ($colonne == '') ? "($indice" : ",$indice";
                $value .= ($value == '') ? "(?" : ",?";
                $valeurs[] = $valeur;
            }
        }
        $colonne .= ")";
        $value .= ")";
        $sql = "insert into $table $colonne values $value";
        $stmt = $connexion->prepare($sql);
        $stmt->execute($valeurs);
    }

    public function tableUpdate($table, $data, $conditions)
    {
        $connexion = $this->connexion();
        $colonne = "";
        $valeurs = [];
        $condition = "";

        foreach ($data as $indice => $valeur) {
            $colonne .= (!$colonne) ? "$indice = ?" : ",$indice = ?";
            $valeurs[] = $valeur;
        }
        foreach ($conditions as $indice => $valeur) {
            $condition .= (!$condition) ? "where $indice = ?" : " and $indice = ?";
            $valeurs[] = $valeur;
        }
        $sql = "update $table set $colonne $condition";

        $stmt = $connexion->prepare($sql);
        $resultat = $stmt->execute($valeurs);
    }

    public function tableDelete($table, $conditions)
    {
        $connexion = $this->connexion();
        $condition = "";
        foreach ($conditions as $indice => $valeur) {
            $condition .= (!$condition) ? " where $indice=?" : " and $indice=?";
            $valeurs[] = $valeur;
        }
        $sql = "delete from $table $condition";
        $stmt = $connexion->prepare($sql);
        $stmt->execute($valeurs);
    }

    public function tableFindOneBy($table, $conditions = [], $orders = [])
    {
        $valeurs = [];
        $condition = '';
        $order = '';
        if ($conditions) {
            $condition = 'where';
            foreach ($conditions as $indice => $valeur) {
                $condition .= ($condition == 'where') ? " $indice=?" : " and $indice=?";
                $valeurs[] = $valeur;
            }
        } else {
            $condition = '';
        }
        if ($orders) {
            $order = 'order by';
            foreach ($orders as $indice => $valeur) {
                $order .= ($order == 'order by') ? " $indice $valeur" : " ,$indice $valeur";
            }
        }
        $sql = "select * from $table $condition $order";
        $stmt = $this->connexion()->prepare($sql);
        $stmt->execute($valeurs);
        $resultat = $stmt->fetch();
        return $resultat;
    }
}
