<div class="container">
    <div class="content">
        <h1 class="my-4 text-light bg-dark text-center">Liste des rôles</h1>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <a href="index.php?control=role&action=insert_update&id=0" class="btn btn-md btn-primary my-4">Nouveau rôle</a>
        </div>
    </div>
    <table class="table table-responsive">
        <tr>
            <th class="">Rang</th>
            <th class="">Libelle</th>
            <th class="text-center">Actions</th>
        </tr>
        <tbody id="roles_rows">
            <?= $lignesRoles ?>
        </tbody>
    </table>
</div>
<script>
    document.getElementById("search_btn").href="javascript:searchRole()";

    function touche(e){
        if(e.keyCode == 13) {
            searchUser();
        }
    }

    function searchUser() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?control=role&action=search');
        var data = new FormData();
        var mot = document.querySelector('#mot').value;
        data.append('mot', mot);
        //envoie vers php
        xhr.send(data);
        // retour de php
        xhr.onload = function() {
            var html = xhr.responseText;
            // alert (html);
            document.getElementById('roles_rows').innerHTML = html;
        }
    }

    function confirmerSuppression(id) {
        if (confirm('Voulez-vous vraiment supprimer ce rôle ?')) {
            // redirection
            var url = "index.php?control=role&action=delete&id="+id;
            // alert(url);
            document.location.href=url;
        } 
    }
</script>