<?php

class MessageController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'read':
                    $this->afficherMessage();
                    break;
                case 'write':
                    $this->enregistrerMessage();
                    break;
                default:
                    $this->afficherMessage();
                    break;
            }
        } else {
            $this->afficherMessage();
        }
    }

    public function afficherMessage()
    {
        $m = new Manager;
        $messages = $m->tablefindAll('message');
        $messages = json_encode($messages);
        echo $messages;
    }

    public function enregistrerMessage()
    {
        $m = new Manager;
        $auteur = $_POST['auteur'];
        $message = $_POST['content_message'];
        if ($message) {
            $connexion = $m->connexion();
            $sql = "insert into message (auteur, message) values (?, ?)";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$auteur, $message]);
            echo "$auteur a écrit $message";
        } else {
            echo "Aucun message";
        }
    }
}
