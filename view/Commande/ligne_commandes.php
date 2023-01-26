<div class="container-fluid">
    <h1 style="line-height:70px" class="text-center bg-dark text-light">Siaisie Ligne Commande</h1>
    <div class="row">
        <div class="col-md-7 p-5">
            <input type="hidden" id="commande_id" disabled name="commande_id" value="<?= $commande['commande_id'] ?>">
            <div class="m-4 row">
                <label for="" class="lab20 col-2">Numero : </label>
                <input class="col-6" type="text" disabled value="<?= $commande['numcommande'] ?>">
            </div>
            <div class="m-4 row">
                <label for="" class="lab20 col-2">Date : </label>
                <input class="col-6" type="text" disabled value="<?= $commande['datecommande'] ?>">
            </div>
            <div class="m-4 row">
                <label for="" class="lab20 col-2">Client : </label>
                <input class="col-6" type="text" disabled value="<?= $commande['nomclient'] ?>">
            </div>
        </div>
        <div class="col-md-5 p-5">
            <p id="montant" style="line-height:100px; border:solid 1px grey; border-radius:1px;" class="display-2 text-end p-2 px-5"><?= $total ?></p>

        </div>
    </div>
    <div>
        <button class="btn btn-primary mx-3 btn-lg"><a class="text-light text-decoration-none" href="javascript:history.back()">Retour</a></button>
    </div>
</div>
<div class="mt-4">
    <table class="table table-responsive table-striped">
        <thead class="bg-dark text-light">
            <tr>
                <th class="text-start px-5">Code</th>
                <th class="text-start px-2">Désignation</th>
                <th class="text-center">Prix unitaire</th>
                <th class="text-center">Quantité</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <?php
        $select = "<select id='article_id' name='article_id' class='form-select w-75' onChange='chercher_article()'>";
        $select .= "<option value='0'>Choisir un article</option>";
        foreach ($articles as $article) {
            $id = $article['id'];
            $numarticle = $article['numarticle'];
            $designation = $article['designation'];
            $prixunitaire = $article['prixunitaire'];
            $select .= "<option title='$designation $prixunitaire €' value='$id'>$numarticle</option>";
        }
        $select .= "</select>";
        ?>
        <tbody>
            <tr>
                <td class="px-2"><?= $select ?></td>
                <td class="px-2" id="td_designation"></td>
                <td class="px-2 text-end" id="td_prixunitaire"></td>
                <td class="px-2 text-end" style="width:10%" id="td_quantite"><input type="text" onkeydown="touche_sur_quantite(event)" class="form-control" id="quantite" name="quantite"></td>
                <td class="text-center px-2"><a href="javascript:valider_quantite()" class="btn btn-md btn-primary">Valider</a></td>
            </tr>
        </tbody>
        <tbody id="tbody_ligne_commande">
            <?= $row_ligne_commande ?>
        </tbody>
        <tfoot>
            <tr class="bg-dark text-light">
                <td class="text-end fw-bold" colspan='4'>Total de la commande</td>
                <td id="td_total" class="text-center"><?= $total ?></td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    function chercher_article() {
        // alert('Ah ! vous allez chercher un article correspondant !');
        var article_id = document.getElementById('article_id').value;
        // alert('Ah ! vous allez chercher un article correspondant à article_id=' + article_id);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?control=lignecommande&action=search_article');
        var data = new FormData();
        data.append('article_id', article_id);
        xhr.send(data);
        xhr.onload = function() {
            var response = xhr.responseText;
            var responses = JSON.parse(response);
            document.getElementById('td_designation').innerHTML = responses['designation'];
            document.getElementById('td_prixunitaire').innerHTML = responses['prixunitaire'];
            document.getElementById('quantite').focus();
        }
    }

    function valider_quantite() {
        // alert("ok");
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?control=lignecommande&action=submit_quantite');

        var commande_id = document.getElementById('commande_id').value;
        var article_id = document.getElementById('article_id').value;
        var quantite = document.getElementById('quantite').value;

        var data = new FormData();
        data.append('commande_id', commande_id);
        data.append('article_id', article_id);
        data.append('quantite', quantite);

        xhr.send(data);
        xhr.onload = function() {
            var response = xhr.responseText;
            // alert(response);
            var responses = JSON.parse(response);
            // console.log(responses);
            document.getElementById('tbody_ligne_commande').innerHTML = responses['row_ligne_commande'];
            document.getElementById('montant').innerHTML = responses['total'];
            document.getElementById('td_total').innerHTML = responses['total'];
            // valider les zones de saisie
            document.getElementById('article_id').value = 0;
            document.getElementById('td_designation').innerHTML = '';
            document.getElementById('td_prixunitaire').innerHTML = '';
            document.getElementById('quantite').value = '';
        }
    }

    function touche_sur_quantite(event) {
        if (event.keyCode == 13) {
            valider_quantite();
        }
    }
</script>