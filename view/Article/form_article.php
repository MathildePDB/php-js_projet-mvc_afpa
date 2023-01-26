<div class="">
    <?php if (empty($id)) {
        $id = 0;
    } ?>
    <h1 class="p-3"><?= $id ? "Détails de l'" : 'Ajouter un ' ?>article</h1>
    <form class="form-control p-5" action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <input type="hidden" id='submit' name="submit" disabled value="<?= $submit ?>">
                <input type="hidden" id='id' <?= $etat ?> name="id" disabled value="<?= $id ?? '' ?>">
                <div class="p-4">
                    <label class="col-2" for="numarticle">Code : </label>
                    <input class="form-control" type="text" id='numarticle' <?= $etat ?> size="60" name="numarticle" maxlenght="20" value="<?= $numarticle ?? '' ?>" placeholder="Ne rien saisir pour automatiser la saisie">
                </div>
                <div class="p-4">
                    <label class="col-2" for="designation">Désignation : </label>
                    <input class="form-control" type="text" id='designation' <?= $etat ?> size="60" name="designation" maxlenght="100" value="<?= $designation ?? '' ?>">
                </div>
                <div class="p-4">
                    <label class="col-2" for="prixunitaire">Prix unitaire : </label>
                    <input class="form-control" type="text" id='prixunitaire' <?= $etat ?> size="20" name="prixunitaire" maxlenght="20" value="<?= $prixunitaire ?? '' ?>">
                </div>
                <div class="p-4">
                    <label class="col-2" for="prixrevient">Prix de revient : </label>
                    <input class="form-control" type="text" id='prixrevient' <?= $etat ?> size="20" name="prixrevient" maxlenght="20" value="<?= $prixrevient ?? '' ?>">
                </div>
            </div>
            <div class="col-md-4 text-center">
                <img id="photo_article" class="w-50" src=<?= ($photo) ? "public/img/$photo" : "public/img/picture.png" ?> alt="Sélectionner une image">
                <input class="form-control my-5" <?= $etat ?> type="file" id="photo" name="photo" onchange="previewImage(this, 'photo_article')">
            </div>
        </div>
        <div class="p-5 text-center">
            <button class="btn btn-primary mx-3 btn-lg"><a class="text-light text-decoration-none" href="javascript:history.back()">Retour à la liste</a></button>
            <button class="btn btn-success mx-3 btn-lg" type="submit" value="valider">Valider</button>
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
    var submit=document.getElementById('submit').value;
        if(submit==1){
            window.opener.searchMot();
            window.close();
        }
</script>