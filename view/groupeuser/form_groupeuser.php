<div class="">
    <h1 class="p-3">Groupe d'utililsateur</h1>
    <form class="form-control p-5" action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <input type="hidden" id='submit' name="submit" disabled value="<?= $submit ?>">
                <input type="hidden" id='id' <?= $etat ?> name="id" value="<?= $groupeuser->getId() ?? '' ?>">
                <div class="p-4">
                    <label class="col-2" for="libelle">Libellé du groupe : </label>
                    <input class="form-control" type="text" id='libelle' <?= $etat ?> required size="60" name="libelle" maxlenght="20" value="<?= $groupeuser->getLibelle() ?? '' ?>">
                </div>
                <div class="p-4">
                    <label class="col-2" for="roles">Rôles : </label>
                    <ul>
                        <?php
                        $li = "";
                        foreach ($roles as $valeur) {
                            $libelle = $valeur['libelle'];
                            $valeur_id = $valeur['id'];
                            $checked = "";
                            $roles_groupeuser = $groupeuser->getRoles();
                            // if(in_array($libelle,$roles_groupeuser)){
                            //     $checked="checked";
                            // } 
                            if($roles_groupeuser == "") {
                                $checked = "";
                            } elseif (in_array($libelle,$roles_groupeuser)) {
                                $checked = "checked";
                            }
                            $li.= "<li><input type='checkbox' $checked name='roles[]' id='$valeur_id' value='$libelle' >$libelle</li>";
                        }
                        echo $li;
                        ?>
                    </ul>
                    </select>
                </div>
            </div>
        </div>
        <div class="p-5 text-center">
            <button class="btn btn-primary mx-3 btn-lg"><a class="text-light text-decoration-none" href="javascript:history.back()">Retour à la liste</a></button>
            <button class="btn btn-success mx-3 btn-lg" type="submit" <?= $etat ?> >Valider</button>
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