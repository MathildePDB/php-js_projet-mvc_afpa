<div class="">
    <h1 class="p-3">Utilisateur</h1>
    <form class="form-control p-5" action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <input type="hidden" id='submit' name="submit" disabled value="<?= $submit ?>">
                <input type="hidden" id='id' <?= $etat ?> name="id" value="<?= $id ?? '' ?>">
                <div class="p-4">
                    <label class="col-2" for="username">Nom d'utilisateur : </label>
                    <input class="form-control" type="text" id='username' <?= $etat ?> required size="60" name="username" maxlenght="20" value="<?= $username ?? '' ?>">
                </div>
                <div class="p-4">
                    <label class="col-2" for="password">Mot de passe : </label>
                    <input class="form-control" type="password" id='password' <?= $etat ?> autocomplete='off' size="60" name="password" maxlenght="100" value="" <?= $password ? 'placeholder="Ne rien saisir pour conserver l\'ancien mot de passe"' : '' ?>>
                </div>
                <div class="p-4">
                    <label class="col-2" for="email">Email : </label>
                    <input class="form-control" type="text" id='email' <?= $etat ?> required size="20" name="email" maxlenght="20" value="<?= $email ?? '' ?>">
                </div>
                <div class="p-4">
                    <label class="col-2" for="roles">Groupe : </label>
                    <select name="groupeuser_id" id="groupeuser_id" class="form-select" <?= $etat ?> required>
                        <?php
                            $option = "";
                            foreach ($groupes as $groupe) {
                                $libelle = $groupe['libelle'];
                                $selected = "";
                                $groupe_id = $groupe['id'];
                                if($groupe_id == "") {
                                    $selected = "";
                                } else {
                                    $selected = "selected";
                                }
                                $option.= "<option value='$groupe_id' $selected>$libelle</option>";
                            }
                            echo $option;
                        ?>
                    </select>
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