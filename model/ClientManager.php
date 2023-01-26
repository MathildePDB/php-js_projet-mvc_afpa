<?php

// classe enfant issue de Manager

class ClientManager extends Manager
{
    // on écrase le variable tableau pour en faire un objet

    public function findById($id, $type = 'obj')
    {
        $client = $this->tableFindById('client', $id);
        if ($type == 'obj') {
            $client = new Article($client);
        }
        return $client;
    }
    
    // recuperer toutes les lignes en objet

    public function findAll()
    {
        $clients = $this -> tableFindAll('client');
        $clients = new Client($clients);
        return $clients;
    }

    // recuperer le premier resultat de la table 

    public function findOne() {
        $client = $this -> tableFindOne('client'); 
        return $client;
    }
}
