<?php
class MyFct
{
    public function listArticle($articles)
    {
        $ligne = "";
        foreach ($articles as $article) {
            $id = $article['id'];
            $numarticle = $article['numarticle'];
            $designation = $article['designation'];
            $prixunitaire = $article['prixunitaire'];
            $prixunitaire = round($prixunitaire, 2);
            $prixrevient = $article['prixrevient'];
            $prixrevient = round($prixrevient, 2);
            $photo = $article['photo'];
            $afficher = "<a href='index.php?control=article&action=show&id=$id' class='w-25 btn btn-sm btn-success'>Afficher</a>";
            $modifier = "<a href='index.php?control=article&action=insert_update&id=$id' class='w-25 btn btn-sm btn-primary'>Modifier</a>";
            $supprimer = "<a href='javascript:confirmerSuppression($id)' class='w-25 btn btn-sm btn-danger'>Supprimer</a>";
            $actions = "$modifier $afficher $supprimer";
            $ligne .= "<tr>";
            $ligne .= "<td class='align-middle'>$numarticle</td>";
            $ligne .= "<td class='align-middle'>$designation</td>";
            $ligne .= "<td class='right align-middle'>$prixunitaire €</td>";
            $ligne .= "<td class='right align-middle'>$prixrevient €</td>";
            $ligne .= "<td class='text-center align-middle align-middle'><img class='img-min zoom' src='public/img/$photo' width='10%' alt=''></td>";
            $ligne .= "<td class='text-center align-middle'>$actions</td>";
            $ligne .= "</tr>";
        }
        return $ligne;
    }

    public function listClient($clients)
    {
        $ligne = "";
        foreach ($clients as $client) {
            $id = $client['id'];
            $numclient = $client['numclient'];
            $typeclient = $client['typeclient'];
            $nomclient = $client['nomclient'];
            $adresseclient = $client['adresseclient'];
            $telephoneclient = $client['telephoneclient'];
            $photo = $client['photo'];
            $afficher = "<a href='index.php?control=client&action=show&id=$id' class='w-25 btn btn-sm btn-success'>Afficher</a>";
            $modifier = "<a href='index.php?control=client&action=insert_update&id=$id' class='w-25 btn btn-sm btn-primary'>Modifier</a>";
            $supprimer = "<a href='javascript:confirmerSuppression($id)' class='w-25 btn btn-sm btn-danger'>Supprimer</a>";
            $actions = "$modifier $afficher $supprimer";
            $ligne .= "<tr>";
            $ligne .= "<td class='text-start'>$numclient</td>";
            $ligne .= "<td class='text-start'>$typeclient</td>";
            $ligne .= "<td class='text-start'>$nomclient</td>";
            $ligne .= "<td class='text-start'>$adresseclient</td>";
            $ligne .= "<td class='text-start'>$telephoneclient</td>";
            $ligne .= "<td class='text-center'><img class='img-min zoom' src='public/img/$photo' width='10%' alt=''></td>";
            $ligne .= "<td class='text-center'>$actions</td>";
            $ligne .= "</tr>";
        }
        return $ligne;
    }

    public function listCommande($v_commandes)
    {
        $ligne = "";
        if ($v_commandes) {
            foreach ($v_commandes as $v_commande) {
                $id = $v_commande['id'];
                $numcommande = $v_commande['numcommande'];
                $typecommande = $v_commande['typecommande'];
                $datecommande = $v_commande['datecommande'];
                $datecommande = new DateTime($datecommande);
                $datecommande = $datecommande->format('d/m/Y');
                $nomclient = $v_commande['nomclient'];
                $montant = $v_commande['montant'];
                $montant = (float) $montant;
                $afficher = "<a href='index.php?control=lignecommande&action=write&commande_id=$id' class='w-25 btn btn-sm btn-success'>Contenu</a>";
                $modifier = "<a href='index.php?control=commande&action=insert_update&id=$id' class='w-25 btn btn-sm btn-primary'>Modifier</a>";
                $supprimer = "<a href='javascript:confirmerSuppression($id)' class='w-25 btn btn-sm btn-danger'>Supprimer</a>";
                $actions = "$modifier $afficher $supprimer";
                $ligne .= "<tr>";
                $ligne .= "<td>$numcommande</td>";
                $ligne .= "<td>$typecommande</td>";
                $ligne .= "<td>$datecommande</td>";
                $ligne .= "<td>$nomclient</td>";
                $ligne .= "<td class='text-end'>$montant €</td>";
                $ligne .= "<td class='text-center align-middle'>$actions</td>";
                $ligne .= "</tr>";
            }
        } else {
            $ligne .= "<tr>";
            $ligne .= "<td></td>";
            $ligne .= "<td class='text-center'></td>";
            $ligne .= "<td class='text-center'></td>";
            $ligne .= "<td class='center'><i>-Aucun resultat-</i></td>";
            $ligne .= "<td class='text-center'></td>";
            $ligne .= "<td class='text-end'></td>";
            $ligne .= "<td></td>";
            $ligne .= "</tr>";
        }

        return $ligne;
    }

    public function getLigneCommande($v_lignecommandes)
    {
        $ligne = "";
        $total = 0;
        foreach ($v_lignecommandes as $v_lignecommande) {
            $id = $v_lignecommande['id'];
            $numarticle = $v_lignecommande['numarticle'];
            $designation = $v_lignecommande['designation'];
            $prixunitaire = $v_lignecommande['prixunitaire'];
            $quantite = $v_lignecommande['quantite'];
            $montant = $v_lignecommande['montant'];
            $montant = round($montant, 2);
            $total += $montant;
            $ligne .= "<tr>";
            $ligne .= "<td class='text-start px-5'>$numarticle</td>";
            $ligne .= "<td class='text-start px-2'>$designation</td>";
            $ligne .= "<td class='text-center'>$prixunitaire €</td>";
            $ligne .= "<td class='text-center'>$quantite</td>";
            $ligne .= "<td class='text-center'>$montant €</td>";
            $ligne .= "</tr>";
        }
        $lignes = [
            'ligne' => $ligne,
            'total' => $total,
        ];
        return $lignes;
    }

    public function listCommandeDate($commandes)
    {
        // printr($commandes);die;
        $ligne = "";
        foreach ($commandes as $commande) {
            // printr($commande);die;
            $numcommande = $commande['numcommande'];
            $typecommande = $commande['typecommande'];
            $nomclient = $commande['nomclient'];
            $datecommande = $commande['datecommande'];
            $montant = $commande['montant'];
            $montant = round($montant, 2);
            $ligne .= "<tr>";
            $ligne .= "<td>$numcommande</td>";
            $ligne .= "<td>$typecommande</td>";
            $ligne .= "<td>$nomclient</td>";
            $ligne .= "<td>$datecommande</td>";
            $ligne .= "<td>$montant €</td>";
            $ligne .= "</tr>";
        }
        return $ligne;
    }

    public function listLigneCommande($lignecommandes)
    {
        $ligne = "";
        foreach ($lignecommandes as $lignecommande) {
            $commande_id = $lignecommande['commande_id'];
            $article_id = $lignecommande['article_id'];
            $quantite = $lignecommande['quantite'];
            $ligne .= "<tr>";
            $ligne .= "<td>$commande_id</td>";
            $ligne .= "<td>$article_id</td>";
            $ligne .= "<td>$quantite</td>";
            $ligne .= "</tr>";
        }
        return $ligne;
    }

    public function listUser($users)
    {
        $ligne = "";
        foreach ($users as $user) {
            $id = $user['id'];
            $username = $user['username'];
            $password = '*******';
            $role = $user['libelle'];
            $email = $user['email'];
            $dateconnexion = $user['dateconnexion'];
            // $dateconnexion = new DateTime($dateconnexion);
            // $dateconnexion = $dateconnexion->format('d/m/Y H:i:s');
            $afficher = "<a href='index.php?control=user&action=show&id=$id' class='btn btn-sm btn-success'>Afficher</a>";
            $modifier = "<a href='index.php?control=user&action=insert_update&id=$id' class='btn btn-sm btn-primary'>Modifier</a>";
            $supprimer = "<a href='javascript:confirmerSuppression($id)' class='btn btn-sm btn-danger'>Supprimer</a>";
            $actions = "$modifier $afficher $supprimer";
            $ligne .= "<tr>";
            $ligne .= "<td>$username</td>";
            $ligne .= "<td>$password</td>";
            $ligne .= "<td>$role</td>";
            $ligne .= "<td>$email</td>";
            $ligne .= "<td>$dateconnexion</td>";
            $ligne .= "<td class='text-center align-middle'>$actions</td>";
            $ligne .= "</tr>";
        }
        return $ligne;
    }

    public function listGroupeuser($groupeusers)
    {
        $ligne = "";
        foreach ($groupeusers as $groupeuser) {
            $id = $groupeuser->getId();
            $libelle = $groupeuser->getLibelle();
            $roles = $groupeuser->getRoles();
            $roles = json_decode($roles);
            krsort($roles);
            $roles_select = "<select class='form-select'>";
            foreach ($roles as $role) {
                $roles_select .= "<option>$role</option>";
            }
            $roles_select .= "</select>";
            $afficher = "<a href='index.php?control=groupeuser&action=show&id=$id' class='btn btn-sm btn-success'>Afficher</a>";
            $modifier = "<a href='index.php?control=groupeuser&action=insert_update&id=$id' class='btn btn-sm btn-primary'>Modifier</a>";
            $supprimer = "<a href='javascript:confirmerSuppression($id)' class='btn btn-sm btn-danger'>Supprimer</a>";
            $actions = "$modifier $afficher $supprimer";
            $ligne .= "<tr>";
            $ligne .= "<td>$libelle</td>";
            $ligne .= "<td>$roles_select</td>";
            $ligne .= "<td class='text-center align-middle'>$actions</td>";
            $ligne .= "</tr>";
        }
        return $ligne;
    }

    public function listArticleAccueil($articles)
    {
        $ligne = "";
        foreach ($articles as $article) {
            $designation = $article['designation'];
            $prixunitaire = $article['prixunitaire'];
            $photo = $article['photo'];
            $ligne .= "<div class='m-2 d-flex flex-column justify-content-center align-items-center p-3'>";
            $ligne .= "<img class='img-medium' src='public/img/$photo' alt=''>";
            $ligne .= "<h4 class='text-center pt-2'>$designation</h4>";
            $ligne .= "<p class='text-center align-bottom'>$prixunitaire</p>";
            $ligne .= "</div>";
        }
        return $ligne;
    }

    public function listRole($roles) {
        $ligne = "";
        foreach ($roles as $role) {
            $id = $role['id'];
            $rang = $role['rang'];
            $libelle = $role['libelle'];
            $afficher = "<a href='index.php?control=role&action=show&id=$id' class='btn btn-sm btn-success'>Afficher</a>";
            $modifier = "<a href='index.php?control=role&action=insert_update&id=$id' class='btn btn-sm btn-primary'>Modifier</a>";
            $supprimer = "<a href='javascript:confirmerSuppression($id)' class='btn btn-sm btn-danger'>Supprimer</a>";
            $actions = "$modifier $afficher $supprimer";
            $ligne .= "<tr>";
            $ligne .= "<td>$rang</td>";
            $ligne .= "<td>$libelle</td>";
            $ligne .= "<td class='text-center align-middle'>$actions</td>";
            $ligne .= "</tr>";
        }
        return $ligne;
    }

}
