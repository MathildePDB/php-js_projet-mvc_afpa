<?php

class CommandeController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'list':
                    $this->listerCommande();
                    break;
                case 'insert_update':
                    if (isset($url['id'])) {
                        $id = $url['id'];
                    } else {
                        $id = 0;
                    }
                    $this->insererModifierCommande($id);
                    break;
                case 'delete':
                    $id = $url['id'];
                    $this->supprimerCommande($id);
                    break;
                case 'show':
                    $id = $url['id'];
                    $this->afficherCommande($id);
                    break;
                case 'search':
                    $this->chercherCommande();
                    break;
                case 'error':
                    $this -> messageErreur();
                break;
            }
        }
    }

    public function listerCommande()
    {
        // index.php?control=commande&action=list
        $file = 'view/commande/commandes.php';
        $m = new Manager;
        $myFct = new MyFct;
        $commandes = $m->tableFindAll('v_liste_commande');
        $commande_rows = $myFct->listCommande($commandes);
        generate($file, ['lignesCommande' => $commande_rows]);
    }

    function insererModifierCommande($id)
    {
        $m = new Manager;
        $types = $m -> tableFindAll('type');
        $clients = $m -> tableFindAll('client');
        if ($id == 0) {  // insertion ou creation 
            $commande = [
                'id' => 0,
                'numcommande' => '',
                'client_id' => '',
                'datecommande' => '',
                'typecommande' => '',
                'etat' => '',
                'types' => $types,
                'clients' => $clients,
                'submit' => 0,
            ];
        } else {   // modification
            $commande = $m->tableFindById('commande', $id);
            $commande['etat'] = '';
            $commande['submit'] = 0;
            $commande['types'] = $types;
            $commande['clients'] = $clients;
        }
        if ($_POST) {
            $commande['submit'] = 1;
            $connexion = $m->connexion();
            $numcommande = $_POST['numcommande'];
            $client_id = $_POST['client_id'];
            $datecommande = $_POST['datecommande'];
            $datecommande = new dateTime($commande['datecommande']);
            $datecommande = $datecommande->format('d/m/Y');
            $typecommande = $_POST['typecommande'];
            if ($id == 0) {
                if ($numcommande == '') {
                    $sql = "insert into commande (client_id, datecommande, typecommande) values (?, ?, ?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$client_id, $datecommande, $typecommande]);
                } else {
                    $sql = "insert into commande (numcommande, client_id, datecommande, typecommande) values (?, ?, ?, ?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$numcommande, $client_id, $datecommande, $typecommande]);
                }
            } else {
                $sql = "update commande set numcommande=?, client_id=?, datecommande=?, typecommande=? where id=?";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$numcommande, $client_id, $datecommande, $typecommande, $id]);
            }
            header('location:index.php?control=commande&action=list');
            exit;
        }
        $file = 'view/commande/form_commande.php';    
        generate($file, $commande);
    }

    function afficherCommande($id)
    {
        $m = new Manager;
        $commande = $m->tableFindById('commande', $id);
        $clients = $m -> tableFindAll('client');
        $types = $m -> tableFindAll('type');
        $commande['etat'] = 'disabled';
        $commande['submit'] = 0;
        $commande['clients'] = $clients;
        $commande['types'] = $types;
        $file = 'view/commande/form_commande.php';
        generate($file, $commande);
    }

    function supprimerCommande($id)
    {
        $m = new Manager;
        $id_commande = $this -> ligneCommande_commandeId($id);
        if ($id_commande) {
            header('location:index.php?control=commande&action=error');
        } else {
            $connexion = $m->connexion();
            $sql = "delete from commande where id=?";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$id]);
            header('location:index.php?control=commande&action=list');
        }
    }

    function ligneCommande_commandeId($commande_id)
    {
        $m = new Manager;
        $connexion = $m->connexion();
        $sql = "select * from lignecommande where commande_id=?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$commande_id]);
        $id_commande = $stmt -> fetch();
        if ($id_commande) {
            return 1;
        } else {
            return 0;
        }
    }

    function chercherCommande(){
        $m = new Manager;
        $myFct = new MyFct;
        $mot = $_POST["mot"];
        $connexion = $m->connexion();
        $sql = "select * from v_liste_commande where numcommande like ?
         or typecommande like ? or nomclient like ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(["%$mot%","%$mot%","%$mot%"]);
        $commandes = $stmt->fetchAll();
        $commande_rows=$myFct->listCommande($commandes);
        echo $commande_rows;
    }

    function messageErreur() {
        // echo 'impossible de supprimer la commande';
        $file = 'view/error/errors.php';
        $message = "Impossible de supprimer la commande ; des articles ont déjà été sélectionnés.";
        generate($file, ['message' => $message]);
    }
}
