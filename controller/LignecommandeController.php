<?php

class LignecommandeController
{
    public function __construct($url)
    {
        if ($_GET) {
            $action = $url['action'];
            switch ($action) {
                case 'write':
                    // ligne_commande.php?action=wrtie&commande_id=1
                    $commande_id = $_GET['commande_id'];
                    $this->saisirLigneCommande($commande_id);
                    break;
                case 'search_article':
                    $this->chercherArticle();
                    break;
                case 'submit_quantite':
                    $this->validerQuantite();
                    break;
            }
        } else {
        }
    }

    public function saisirLigneCommande($commande_id)
    {
        $m = new Manager;
        $myFct = new MyFct;
        $commande = $m->tableFindById('commande', $commande_id);



        $connexion = $m->connexion();
        $sql = "select cd.id as commande_id, * from commande cd, client cl where cd.client_id=cl.id and cd.id=?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$commande_id]);
        $commande = $stmt->fetch();

        // printr($commande);die;

        $datecommande = new dateTime($commande['datecommande']);
        $datecommande = $datecommande->format('d/m/Y');
        $commande['datecommande'] = $datecommande;
        $articles = $m->tableFindAll('article');
        $v_ligne_commandes = $this->v_ligne_commande($commande_id);
        $lignes = $myFct->getLigneCommande($v_ligne_commandes);
        $row_ligne_commande = $lignes['ligne'];
        $total = $lignes['total'];
        $total = number_format($total, 2, '.', ' ');
        // $row_ligne_commande = getLigneCommande($v_ligne_commandes);
        $file = 'view/commande/ligne_commandes.php';
        generate($file, [
            'commande' => $commande,
            'articles' => $articles,
            'row_ligne_commande' => $row_ligne_commande,
            'total' => "$total €",
        ]);
    }

    public function v_ligne_commande($commande_id)
    {
        $m = new Manager;
        $ligne_commandes = $m->tableFindAllBy('v_detail_commande', ['commande_id' => $commande_id]);

        $connexion = $m->connexion();
        $sql = "select ln.id, ln.commande_id, ln.article_id, ar.numarticle, ar.designation, ar.prixunitaire, ln.quantite, 
        round(ln.quantite*ar.prixunitaire,2) as montant
        from commande cd, lignecommande ln, article ar 
        where cd.id=ln.commande_id and ln.article_id=ar.id and commande_id=? 
        order by id desc";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$commande_id]);
        $ligne_commandes = $stmt->fetchAll();

        return $ligne_commandes;
    }

    public function chercherArticle()
    {
        $m = new Manager;
        $article_id = $_POST['article_id'];
        $article = $m->tableFindById('article', $article_id);
        $article = json_encode($article);
        echo $article;
    }

    public function validerQuantite()
    {
        $commande_id = $_POST['commande_id'];
        $article_id = $_POST['article_id'];
        $quantite = $_POST['quantite'];
        $myFct = new MyFct;
        $m = new Manager;

        $connexion = $m->connexion();
        $sql = "insert into lignecommande (commande_id, article_id, quantite) values (?,?,?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$commande_id, $article_id, $quantite]);

        $v_ligne_commandes = $this->v_ligne_commande($commande_id);

        $lignes = $myFct->getLigneCommande($v_ligne_commandes);
        $row_ligne_commande = $lignes['ligne'];
        $total = $lignes['total'];
        $total = number_format($total, 2, '.', ' ');
        $responses = ['row_ligne_commande' => $row_ligne_commande, 'total' => $total];
        $responses = json_encode($responses);
        echo $responses;
    }
}
