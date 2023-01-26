<?php

class AccueilController
{
    public function __construct($url = [])
    {
        $commande_row = $this->listerCommandeDate();
        $articleRow = $this->listerArticle();
        $file = 'view/accueil/accueil.php';
        generate($file, ['lignesCommande' => $commande_row, 'lignesArticle' => $articleRow]);
    }

    public function listerCommandeDate()
    {
        $file = 'view/accueil/accueil.php';
        $m = new Manager;
        $f = new MyFct;
        $commandes = $m->tableFindAllByLimit('v_liste_commande', [], ['datecommande' => 'desc'], '5');
        $commande_row = $f->listCommandeDate($commandes);
        return $commande_row;
        generate($file, ['lignesCommande' => $commande_row]);
    }

    public function listerArticle()
    {
        $file = 'view/accueil/accueil.php';
        $m = new Manager;
        $myFct = new MyFct;
        $articles = $m->tableFindAll('article');
        $articleRow = $myFct->listArticleAccueil($articles);
        return $articleRow;
        generate($file, ['lignesArticle' => $articleRow]);
    }

}
