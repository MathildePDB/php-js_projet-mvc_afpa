<?php

class AccueilManager extends Manager
{
    // public function findAllBy($conditions=[], $orders=[], $type='obj') {
    //     $commandes = $this -> tableFindAllBy('v_liste_commande', $conditions, $orders);
    //     $objets = [];
    //     if ($type == 'obj') {
    //         foreach ($commandes as $valeur) {
    //             $objet = new Accueil($valeur);
    //             $objets[] = $objet;
    //         }
    //         return $objets;
    //     } else {
    //         return $commandes;
    //     }
    // }

    public function findAllByLimit($conditions=[], $orders=[], $limit=[], $type='obj') {
        $commandes = $this -> tableFindAllByLimit('v_liste_commande', $conditions, $orders, $limit);
        $objets = [];
        if ($type == 'obj') {
            foreach ($commandes as $valeur) {
                $objet = new Accueil($valeur);
                $objets[] = $objet;
            }
            return $objets;
        } else {
            return $commandes;
        }
    }
}