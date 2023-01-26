<?php

class RoleController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'list':
                    $this->listerRole();
                    break;
                case 'insert_update':
                    if (isset($url['id'])) {
                        $id = $url['id'];
                    } else {
                        $id = 0;
                    }
                    $this->insererModifierRole($id);
                    break;
                case 'delete':
                    $id = $url['id'];
                    $this->supprimerRole($id);
                    break;
                case 'show':
                    $id = $url['id'];
                    $this->afficherRole($id);
                    break;
                case 'error':
                    $this->messageErreur();
                    break;
            }
        }
    }

    public function listerRole()
    {
        // index.php?control=role&action=list
        $file = 'view/role/roles.php';
        $m = new Manager;
        $myFct = new MyFct;
        $connexion = $m->connexion();
        $sql = "select * from role";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $roles = $stmt->fetchAll();
        $roles_rows = $myFct->listRole($roles);
        generate($file, ['lignesRoles' => $roles_rows]);
    }

    function insererModifierRole($id)
    {
        $m = new Manager;
        if ($id == 0) { 
            $role = [
                'id' => 0,
                'rang' => '',
                'libelle' => '',
                'etat' => '',
                'submit' => 0,
            ];
        } else {   // modification
            $role = $m->tableFindById('role', $id);
            $role['etat'] = '';
            $role['submit'] = 0;
        }
        if ($_POST) {
            $role['submit'] = 1;
            $connexion = $m->connexion();
            $rang = $_POST['rang'];
            $libelle = $_POST['libelle'];
            if ($id == 0) {
                    $sql = "insert into role (rang, libelle) values (?, ?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$rang, $libelle]);
                } else {
                $sql = "update role set rang=?, libelle=? where id=?";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$rang, $libelle, $id]);
            }
            header('location:index.php?control=role&action=list');
            exit;
        }
        $file = 'view/role/form_role.php';    
        generate($file, $role);
    }

    public function afficherRole($id)
    {
        $m = new Manager;
        $role = $m->tableFindById('role', $id);
        $role['etat'] = 'disabled';
        $role['submit'] = 0;
        $file = 'view/role/form_role.php';
        generate($file, $role);
    }

    public function supprimerRole($id)
    {
        $um = new RoleManager;
        $um->delete(['id' => $id]);
        header('location:index.php?control=role&action=list');
    }

    public function messageErreur()
    {
        $file = 'view/error/errors.php';
        $message = "Impossible de supprimer ce rôle.";
        generate($file, ['message' => $message]);
    }
}
