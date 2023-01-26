<?php

class GroupeuserController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'list':
                    $this->listerGroupeuser();
                    break;
                case 'insert_update':
                    if (isset($url['id'])) {
                        $id = $url['id'];
                    } else {
                        $id = 0;
                    }
                    $this->insererModifierGroupeuser($id);
                    break;
                case 'delete':
                    $id = $url['id'];
                    $this->supprimerGroupeuser($id);
                    break;
                case 'show':
                    $id = $url['id'];
                    $this->afficherGroupeuser($id);
                    break;
                case 'error':
                    $this->messageErreur();
                    break;
            }
        }
    }

    public function listerGroupeuser()
    {
        $file = 'view/groupeuser/groupeusers.php';
        $gm = new GroupeuserManager;
        $myFct = new MyFct;
        $groupeusers = $gm->findAllBy([], ['id' => 'desc']);
        $groupeuser_rows = $myFct->listGroupeuser($groupeusers);
        generate($file, ['lignesGroupeusers' => $groupeuser_rows]);
    }

    function insererModifierGroupeuser($id)
    {
        $m = new Manager;
        $gm = new GroupeuserManager;
        $roles = $m->tableFindAllBy('role',[],['rang' => 'asc']);
        $etat = '';
        $submit = 0;
        if ($id == 0) { 
            $groupeuser = [
                'id' => 0,
                'libelle' => '',
                'roles' => '',
            ];
            $groupeuser = new Groupeuser($groupeuser);
            // $groupeuser->getId(0);
            // printr($groupeuser);die;
        } else { 
            $groupeuser = $gm->findById($id);
        }
        $roles_groupeuser=$groupeuser->getRoles();
        $roles_groupeuser=json_decode($roles_groupeuser);
        $groupeuser->setRoles($roles_groupeuser);
        // printr($groupeuser);die;
        if ($_POST) {
            $submit = 1;
            $data = $_POST;
            $roles_data = $data['roles'];
            $roles_data = json_encode($roles_data,true);
            $data['roles'] = $roles_data;
            if ($id == 0) {
               $gm->insert($data);
            } else {
                $gm->update($data, ['id' => $id]);
            }
            header('location:index.php?control=groupeuser&action=list');
            exit;
        }
        $file = 'view/groupeuser/form_groupeuser.php';
        generate($file, ['groupeuser'=>$groupeuser,'roles'=>$roles,'etat'=>$etat,'submit'=>$submit]);
    }

    public function afficherGroupeuser($id)
    {
        $m = new Manager;
        $gm = new GroupeuserManager;
        $groupeuser = $gm->findById($id);
        $etat = 'disabled';
        $roles = $m->tableFindAllBy('role',[],['rang'=>'asc']);
        $roles_groupeuser = $groupeuser->getRoles();
        $roles_groupeuser = json_decode($roles_groupeuser);
        $groupeuser->setRoles($roles_groupeuser);
        $submit=0;       
        $file='view/groupeuser/form_groupeuser.php';
        generate($file,['groupeuser'=>$groupeuser, 'etat' => $etat, 'submit' => $submit, 'roles'=>$roles]);
    }

    public function supprimerGroupeuser($id)
    {
        $um = new GroupeuserManager;
        $um->delete(['id' => $id]);
        header('location:index.php?control=groupeuser&action=list');
    }

    public function messageErreur()
    {
        $file = 'view/error/errors.php';
        $message = "Impossible de supprimer le groupe.";
        generate($file, ['message' => $message]);
    }
}
