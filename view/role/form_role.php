<div class="">
    <h1 class="p-3">Rôle</h1>
    <form class="form-control p-5" action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <input type="hidden" id='submit' name="submit" disabled value="<?= $submit ?>">
                <input type="hidden" id='id' <?= $etat ?> name="id" value="<?= $submit ?? '' ?>">
                <div class="p-4">
                    <label class="col-2" for="username">Rang : </label>
                    <input class="form-control" type="text" id='rang' <?= $etat ?> required size="60" name="rang" maxlenght="20" value="<?= $rang ?? '' ?>">
                </div>
                <div class="p-4">
                    <label class="col-2" for="libelle">Libelle : </label>
                    <input class="form-control" type="text" id='libelle' <?= $etat ?> size="60" name="libelle" maxlenght="100" value="<?= $libelle ?? '' ?>">
                </div>
            </div>
        </div>
        <div class="p-5 text-center">
            <button class="btn btn-primary mx-3 btn-lg"><a class="text-light text-decoration-none" href="javascript:history.back()">Retour à la liste</a></button>
            <button class="btn btn-success mx-3 btn-lg" type="submit" <?= $etat ?> name="valider" value="valider">Valider</button>
        </div>
    </form>
</div>
<script>
    var submit = document.getElementById('submit').value;
    if (submit == 1) {
        window.opener.searchMot();
        window.close();
    }
</script>