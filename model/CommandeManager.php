<?php

// classe enfant issue de Manager

class CommandeManager extends Manager
{
    // on écrase le variable tableau pour en faire un objet

    public function findById($id, $type = 'obj')
    {
        $commande = $this->tableFindById('commande', $id);
        if ($type == 'obj') {
            $commande = new Article($commande);
        }
        return $commande;
    }
    
    // recuperer toutes les lignes en objet

    public function findAll()
    {
        $commandes = $this -> tableFindAll('commande');
        $commandes = new Commande($commandes);
        return $commandes;
    }

    // recuperer le premier resultat de la table 

    public function findOne() {
        $commande = $this -> tableFindOne('commande'); 
        return $commande;
    }
}
