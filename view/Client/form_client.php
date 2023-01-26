<div class="">
    <?php if (empty($id)) {
        $id = 0;
    } ?>
    <h1 class="p-3"><?= $id ? '' : 'Ajouter un' ?> Client</h1>
    <form class="form-control p-3" action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <input type="hidden" id='submit' name="submit" value="<?= $submit ?>">
                <input type="hidden" id="id" <?= $etat ?> name="id" maxlenght="20" value="<?= $id ?? '' ?>">
                <div class="p-4 row">
                    <label class="col-3 align-self-center" for="numclient">Numero : </label>
                    <input class="col form-control" type="text" id="numclient" <?= $etat ?> size="20" name="numclient" maxlenght="20" value="<?= $numclient ?? ''  ?>" placeholder="Ne rien saisir pour automatiser la saisie">
                </div>
                <div class="p-4 row">
                    <label class="col-3 align-self-center" for="nomclient">Nom : </label>
                    <input class="col form-control" type="text" id="nomclient" <?= $etat ?> size="20" name="nomclient" maxlenght="20" value="<?= $nomclient ?? '' ?>">
                </div>
                <div class="p-4 row">
                    <label class="col-3 align-self-center" for="adresseclient">Adresse : </label>
                    <input class="col form-control" type="text" id="adresseclient" <?= $etat ?> size="20" name="adresseclient" maxlenght="100" value="<?= $adresseclient ?? '' ?>">
                </div>
                <div class="p-4 row">
                    <label class="col-3 align-self-center" for="telephoneclient">Téléphone : </label>
                    <input class="col form-control" type="text" id="telephoneclient" <?= $etat ?> size="20" name="telephoneclient" maxlenght="100" value="<?= $telephoneclient ?? '' ?>">
                </div>
                <div class="p-4 row">
                    <label class="col-3 align-self-center" for="typeclient">Type : </label>
                    <select class="col form-select" <?= $etat ?> required name="typeclient" id="typeclient">
                        <option value="">Choisissez un type</option>
                        <?php
                        $option = "";
                        foreach ($types as $type) {
                            $type_client = $type['type'];
                            if ($typeclient == $type_client) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $typeclient = $type['nomtype'];
                            $option.= "<option value='$type_client' $selected >$typeclient</option>";
                        }
                        echo $option;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4 text-center align-self-sm-end p-3">
                <img id="photo_client" class="w-50" src=<?= ($photo) ? "public/img/$photo" : "public/img/picture.png" ?> alt="Sélectionner une image">
                <input class="form-control my-5" <?= $etat ?> type="file" id="photo" name="photo" onchange="previewImage(this, 'photo_client')">
            </div>
        </div>
        <div class="p-5 text-center">
            <button class="btn btn-primary mx-3"><a class="text-light text-decoration-none" href="javascript:history.back()">Retour à la liste</a></button>
            <button class="btn btn-success mx-3" type="submit" name="valider" value="valider">Valider</button>
        </div>
    </form>
</div>
<script>
    function previewImage(e, id_affiche_image) {
        var picture = e.files[0];
        if (picture) {
            var image = document.getElementById(id_affiche_image);
            image.src = URL.createObjectURL(picture);
        }
    }
    var submit = document.getElementById('submit').value;
    if (submit == 1) {
        document.getElementById('mot').value='CLT';
        window.opener.searchClient();
        window.close();
    }
</script>