<?php

class SecurityController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'login':
                    $this->userLogin();
                    break;
                case 'logout':
                    $this->userLogout();
                    break;
            }
        }
    }

    public function userLogin()
    {
        $file="view/security/form_login.php";
        $erreur='';
        if($_POST){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $password=crypter($password);
            $um=new UserManager();
            $user=$um->findOneBy(['username'=>$username,'password'=>$password]);
            $id=(int) $user->getId();
            if($id!=0){
                $_SESSION['username']=$username;
                $_SESSION['roles']=$user->getgroupeuser_id();
                header('location:index.php');
                exit();
            }else{
                $erreur='Nom d\'utilisateur ou mot de passe incorrect';
            }
        }
        generate($file,['erreur'=>$erreur]); 
    }

    public function userLogout()
    {
        session_destroy();
        header('location:index.php?control=accueil');
    }
}
