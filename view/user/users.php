<div class="container">
    <div class="content">
        <h1 class="my-4 text-light bg-dark text-center">Liste des utilisateurs</h1>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <a href="index.php?control=user&action=insert_update&id=0" class="btn btn-md btn-primary my-4">Nouvel utilisateur</a>
        </div>
    </div>
    <table class="table table-responsive">
        <tr>
            <th class="">Nom de l'utilisateur</th>
            <th class="">Mot de passe</th>
            <th class="">Rôle</th>
            <th class="">E-mail</th>
            <th class="">Dernière connection</th>
            <th class="text-center">Actions</th>
        </tr>
        <tbody id="users_rows">
            <?= $lignesUsers ?>
        </tbody>
    </table>
</div>
<script>
    document.getElementById("search_btn").href="javascript:searchUser()";

    function touche(e){
        if(e.keyCode == 13) {
            searchUser();
        }
    }

    function searchUser() {
        // alert ("bonjour");
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?control=users&action=search');
        var data = new FormData();
        var mot = document.querySelector('#mot').value;
        data.append('mot', mot);
        //envoie vers php
        xhr.send(data);
        // retour de php
        xhr.onload = function() {
            var html = xhr.responseText;
            // alert (html);
            document.getElementById('users_rows').innerHTML = html;
        }
    }

    function confirmerSuppression(id) {
        if (confirm('Voulez-vous vraiment supprimer cet utilisateur ?')) {
            // redirection
            var url = "index.php?control=user&action=delete&id="+id;
            // alert(url);
            document.location.href=url;
        } 
    }

    // function modifierArticle(id) {
    //     var url="index.php?control=article&action=insert_update&id="+id;
    //     popupCenter(url, 'modifier_'+id,screen.width*0.70,screen.height*0.50);
    // }

    // function creerArticle() {
    //     var url = "index.php?control=article&action=insert_update&id=0";
    //     popupCenter(url, 'creer_',screen.width*0.70,screen.height*0.50);
    // }

    // function afficherArticle(id) {
    //     var url="index.php?control=article&action=show&id="+id;
    //     popupCenter(url, 'afficher_'+id,screen.width*0.70,screen.height*0.50);
    // }
</script>