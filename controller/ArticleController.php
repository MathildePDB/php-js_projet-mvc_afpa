<?php

class ArticleController
{
    public function __construct($url)
    {
        if ($url) {
            $action = $url['action'];
            switch ($action) {
                case 'list':
                    $this->listerArticle();
                    break;
                case 'insert_update':
                    if (isset($url['id'])) {
                        $id = $url['id'];
                    } else {
                        $id = 0;
                    }
                    $this->insererModifierArticle($id);
                    break;
                case 'delete':
                    $id = $url['id'];
                    $this->supprimerArticle($id);
                    break;
                case 'show':
                    $id = $url['id'];
                    $this->afficherArticle($id);
                    break;
                case 'search':
                    $this->chercherArticle();
                    break;
                case 'error':
                    $this->messageErreur();
                    break;
            }
        }
    }

    public function listerArticle()
    {
        // index.php?control=article&action=list
        $file = 'view/article/articles.php';
        $am = new ArticleManager;
        $myFct = new MyFct;
        $articles = $am->findAll('article');
        $article_rows = $myFct->listArticle($articles);
        generate($file, ['lignesArticle' => $article_rows]);
    }

    function insererModifierArticle($id)
    {
        $m = new Manager;
        if ($id == 0) {  // insertion ou creation 
            $article = [
                'id' => 0,
                'numarticle' => '',
                'designation' => '',
                'prixunitaire' => '',
                'prixrevient' => '',
                'photo' => '',
                'etat' => '',
                'submit' => 0,
            ];
            $photo = '';
        } else {   // modification
            $article = $m->tableFindById('article', $id);
            $article['etat'] = '';
            $photo = $article['photo'];
            $article['submit'] = 0;
        }
        if ($_POST) {
            $article['submit'] = 1;
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
            $numarticle = $_POST['numarticle'];
            $designation = $_POST['designation'];
            $prixunitaire = $_POST['prixunitaire'];
            $prixrevient = $_POST['prixrevient'];
            if ($id == 0) {
                if ($numarticle == '') {
                    // $am = new ArticleManager;
                    // $data = $_POST;
                    // $article = $am->insert($data);
                    $sql = "insert into article  (designation, prixunitaire, prixrevient, photo) values (?, ?, ?, ?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$designation, $prixunitaire, $prixrevient, $photo]);
                } else {
                    $sql = "insert into article  (numarticle, designation, prixunitaire, prixrevient, photo) values (?, ?, ?, ?, ?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$numarticle, $designation, $prixunitaire, $prixrevient, $photo]);
                }
            } else {
                $sql = "update article set numarticle=?, designation=?, prixunitaire=?, prixrevient=?, photo=? where id=?";
                $stmt = $connexion->prepare($sql);
                $stmt->execute([$numarticle, $designation, $prixunitaire, $prixrevient, $photo, $id]);
            }
            header('location:index.php?control=article&action=list');
            exit;
        }
        $file = 'view/article/form_article.php';
        generate($file, $article);
    }

    function afficherArticle($id)
    {
        $m = new Manager;
        $article = $m->tableFindById('article', $id);
        $article['etat'] = 'disabled';
        $article['submit'] = 0;
        $file = 'view/article/form_article.php';
        generate($file, $article);
    }

    function supprimerArticle($id)
    {
        $m = new Manager;
        $id_article = $this->ligneCommande_articleId($id);
        if ($id_article) {
            header('location:index.php?control=article&action=error');
        } else {
            $connexion = $m->connexion();
            $sql = "delete from article where id=?";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$id]);
            header('location:index.php?control=article&action=list');
        }
    }

    function ligneCommande_articleId($article_id)
    {
        $m = new Manager;
        $connexion = $m->connexion();
        $sql = "select article_id from lignecommande where article_id=?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$article_id]);
        $id_article = $stmt->fetch();
        if ($id_article) {
            return 1;
        } else {
            return 0;
        }
    }

    function chercherArticle(){
        $m = new Manager;
        $myFct = new MyFct;
        $mot = $_POST["mot"];
        $connexion = $m->connexion();
        $sql = "select * from article where designation like ?
         or numarticle like ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(["%$mot%","%$mot%"]);
        $articles = $stmt->fetchAll();
        $article_rows=$myFct->listArticle($articles);
        //$articles = json_encode($articles);
        echo $article_rows;
    }

    function messageErreur()
    {
        // echo 'impossible de supprimer l article';
        $file = 'view/error/errors.php';
        $message = "Impossible de supprimer l'article ; il est utilisé dans au moins une commande.";
        generate($file, ['message' => $message]);
    }
}
