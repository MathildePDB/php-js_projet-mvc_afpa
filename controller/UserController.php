<?php

class UserController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'list':
                    $this->listerUser();
                    break;
                case 'insert_update':
                    if (isset($url['id'])) {
                        $id = $url['id'];
                    } else {
                        $id = 0;
                    }
                    $this->insererModifierUser($id);
                    break;
                case 'delete':
                    $id = $url['id'];
                    $this->supprimerUser($id);
                    break;
                case 'show':
                    $id = $url['id'];
                    $this->afficherUser($id);
                    break;
                case 'error':
                    $this->messageErreur();
                    break;
            }
        }
    }

    public function listerUser()
    {
        // index.php?control=user&action=list
        $file = 'view/user/users.php';
        $m = new Manager;
        $myFct = new MyFct;
        $connexion = $m->connexion();
        $sql = "select u.id, u.username, u.email, u.dateconnexion, u.groupeuser_id, g.id as groupeId, g.libelle,
        g.roles from users u left join groupeuser g on g.id=u.groupeuser_id";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        $users_rows = $myFct->listUser($users);
        generate($file, ['lignesUsers' => $users_rows]);
    }

    function insererModifierUser($id)
    {
        $m = new Manager;
        $groupes = $m->tableFindAll('groupeuser');
        if ($id == 0) {  // insertion ou creation 
            $user = [
                'id' => 0,
                'username' => '',
                'password' => '',
                'email' => '',
                'groupeuser_id' => '',
                'etat' => '',
                'submit' => 0,
                'groupes' => $groupes,
            ];
        } else {   // modification
            $user = $m->tableFindById('users', $id);
            $user['etat'] = '';
            $user['submit'] = 0;
        }
        if ($_POST) {
            $user['submit'] = 1;
            $connexion = $m->connexion();
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($password){
                $password=crypter($password);
                $_POST['password']=$password;
            }else{
                $_POST['password']=$user->getPassword();
            }
            $email = $_POST['email'];
            $groupeuser_id = $_POST['groupeuser_id'];
            if ($id == 0) {
                    $sql = "insert into users (username, password, email, groupeuser_id) values (?, ?, ?, ?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$username, $password, $email, $groupeuser_id]);
                } else {
                $sql = "update users set username=?, password=?, email=?, groupeuser_id=? where id=?";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$username, $password, $email, $groupeuser_id, $id]);
            }
            header('location:index.php?control=user&action=list');
            exit;
        }
        $file = 'view/user/form_user.php';    
        generate($file, $user);
    }

    public function afficherUser($id)
    {
        $m = new Manager;
        $user = $m->tableFindById('users', $id);
        $groupes = $m->tableFindAll('groupeuser');
        $user['groupes'] = $groupes;
        $user['etat'] = 'disabled';
        $user['submit'] = 0;
        $file = 'view/user/form_user.php';
        generate($file, $user);
    }

    public function supprimerUser($id)
    {
        $um = new UserManager;
        $um->delete(['id' => $id]);
        header('location:index.php?control=user&action=list');
    }

    public function messageErreur()
    {
        $file = 'view/error/errors.php';
        $message = "Impossible de supprimer l'utilisateur.";
        generate($file, ['message' => $message]);
    }
}
