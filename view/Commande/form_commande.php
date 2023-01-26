<div class="col-7">
    <?php if (empty($commande_id)) {
                $commande_id = 0;
            } ?>
    <h1 class="p-3"><?= $id ? 'Modifier la ' : 'Nouvelle ' ?>commande</h1>
    <!-- <h1 class="p-3"><?= $nomination ?>commande</h1> -->
    <form class="form-control p-5" action="" method="POST">
        <input type="hidden" id='commande_id' <?= $etat ?> size="20" name="commande_id" maxlenght="20" value="<?= $commande_id ?? '' ?>">
        <div class="p-3">
            <label class="col-2" for="numcommande">Code :</label>
            <input type="text" id='numcommande' class="form-control" <?= $etat ?> size="60" name="numcommande" maxlenght="20" value="<?= $numcommande ?? '' ?>" placeholder="Ne rien écrire pour automatiser la saisie">
        </div>
        <div class="p-3">
            <label class="col-2" for="client_id">Client : </label>
            <select class="form-select" <?= $etat ?> required name="client_id" id="client_id">
                <option>Choisissez un client</option>
                <?php
                $option = "";
                foreach ($clients as $client) {
                    $id_client = $client['id'];
                    if ($client_id == $id_client) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $nomclient = $client['nomclient'];
                    $option .= "<option value='$id_client' $selected >$nomclient</option>";
                }
                echo $option;
                ?>
            </select>
        </div>
        <div class="p-3">
            <label class="col-2" for="datecommande">Date :</label>
            <?php 
                if ($id == 0) {
                    echo "<input type='date' id='datecommande' class='form-control' $etat size='20' name='datecommande' maxlenght='20'>";
                } else {
                    echo "<input type='text' id='datecommande' class='form-control' $etat size='20' name='datecommande' maxlenght='20' value='$datecommande'>";
                }
            ?>
            
        </div>
        <div class="p-3">
            <label class="col-2" for="typecommande">type : </label>
            <select class="form-select" <?= $etat ?> required name="typecommande" id="typecommande">
                <option>Choisissez un type</option>
                <?php
                $option = "";
                foreach ($types as $type) {
                    $type_commande = $type['type'];
                    if ($typecommande == $type_commande) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $nomtype = $type['nomtype'];
                    $option.= "<option value='$type_commande' $selected >$nomtype</option>";
                }
                echo $option;
                ?>
            </select>
        </div>
        <div class="pt-5 pb-2 text-center">
            <button class="btn btn-primary mx-3"><a class="text-light" href="javascript:history.back()">Retour à la liste</a></button>
            <button class="btn btn-success mx-3" type="submit" name="valider" value="valider">Valider</button>
        </div>
    </form>
</div>
<script>
    var submit = document.getElementById('submit').value;
    if (submit == 1) {
        document.getElementById('mot').value = 'CLT';
        window.opener.searchClient();
        window.close();
    }
</script>