<?php

class ClientController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'list':
                    $this->listerClient();
                    break;
                case 'insert_update':
                    if (isset($url['id'])) {
                        $id = $url['id'];
                    } else {
                        $id = 0;
                    }
                    $this->insererModifierClient($id);
                    break;
                case 'delete':
                    $id = $url['id'];
                    $this->supprimerClient($id);
                    break;
                case 'show':
                    $id = $url['id'];
                    $this->afficherClient($id);
                    break;
                case 'search':
                    $this->chercherClient();
                    break;
                case 'error':
                    $this->messageErreur();
                    break;
            }
        }
    }

    public function listerClient()
    {
        // index.php?control=client&action=list
        $file = 'view/client/clients.php';
        $m = new Manager;
        $myFct = new MyFct;
        $clients = $m->tableFindAll('client');
        $client_rows = $myFct->listClient($clients);
        generate($file, ['lignesClient' => $client_rows]);
    }

    public function insererModifierClient($id)
    {
        $m = new Manager;
        $types = $m->tableFindAll('type');
        if ($id == 0) {  // insertion ou creation 
            $client = [
                'id' => 0,
                'numclient' => '',
                'nomclient' => '',
                'adresseclient' => '',
                'telephoneclient' => '',
                'photo' => '',
                'typeclient' => '',
                'types' => $types,
                'etat' => '',
                'submit' => 0,
            ];
            $photo = '';
        } else {
            $client = $m->tableFindById('client', $id);
            $client['etat'] = '';
            $photo = $client['photo'];
            $client['submit'] = 0;
            $client['types'] = $types;
        }
        if ($_POST) {
            $client['submit'] = 1;
            if ($_FILES['photo']) {
                $image = $_FILES['photo'];
                $name = $image['name'];
                $source = $image['tmp_name'];
                $destination = "public/img/$name";
                $copier = move_uploaded_file($source, $destination);
                if ($copier) {
                    $photo = $name;
                }
            }
            $connexion = $m->connexion();
            $numclient = $_POST['numclient'];
            $typeclient = $_POST['typeclient'];
            $nomclient = $_POST['nomclient'];
            $adresseclient = $_POST['adresseclient'];
            $telephoneclient = $_POST['telephoneclient'];
            if ($id == 0) {
                if ($numclient == '') {
                    $sql = "insert into client (nomclient, adresseclient, telephoneclient, photo, typeclient) values 
                    (?,?,?,?,?) ";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$nomclient, $adresseclient, $telephoneclient, $photo, $typeclient]);
                } else {
                    $sql = "insert into client (numclient, nomclient, adresseclient, telephoneclient, photo, typeclient) values 
                    (?,?,?,?,?,?) ";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$numclient, $nomclient, $adresseclient, $telephoneclient, $photo, $typeclient]);
                }
            } else {
                $sql = "update client set numclient=?, nomclient=?, adresseclient=?, telephoneclient=?, photo=?, typeclient=? where id=?";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$numclient, $nomclient, $adresseclient, $telephoneclient, $photo, $typeclient, $id]);
            }
            header('location:index.php?control=client&action=list');
            exit;
        }
        $file = 'view/client/form_client.php';
        generate($file, $client);
    }

    public function afficherClient($id)
    {
        $m = new Manager;
        $client = $m->tableFindById('client', $id);
        $types = $m->tableFindAll('type');
        $client['types'] = $types;
        $client['etat'] = 'disabled';
        $client['submit'] = 0;
        $file = 'view/client/form_client.php';
        generate($file, $client);
    }

    public function supprimerClient($id)
    {
        $m = new Manager;
        $id_client = $this->Commande_clientId($id);
        if ($id_client) {
            header('location:index.php?control=client&action=error');
        } else {
            $connexion = $m->connexion();
            $sql = "delete from client where id=?";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$id]);
            header('location:index.php?control=client&action=list');
        }
    }

    public function Commande_clientId($id)
    {
        $m = new Manager;
        $connexion = $m->connexion();
        $sql = "select client_id from commande where id=?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$id]);
        $id_client = $stmt->fetch();
        if ($id_client) {
            return true;
        } else {
            return false;
        }
    }

    public function chercherClient() {
        $m = new Manager;
        $myFct = new MyFct;
        $mot = $_POST["mot"];
        $connexion = $m->connexion();
        $sql = "select * from client where numclient like ?
         or nomclient like ? or adresseclient like ? or telephoneclient like ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(["%$mot%","%$mot%","%$mot%","%$mot%"]);
        $clients = $stmt->fetchAll();
        $client_row=$myFct->listClient($clients);
        //$articles = json_encode($articles);
        echo $client_row;
    }

    public function messageErreur()
    {
        // echo 'impossible de supprimer l client';
        $file = 'view/error/errors.php';
        $message = "Impossible de supprimer le client car il a déjà passé commande.";
        generate($file, ['message' => $message]);
    }
}
