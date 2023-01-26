<div class="container">
    <div class="content">
        <h1 class="my-4 text-light bg-dark text-center">Liste des articles</h1>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <a href="index.php?control=article&action=insert_update&id=0" class="btn btn-md btn-primary my-4">Nouvel article</a>
        </div>
    </div>
    <table class="table table-responsive">
        <tr>
            <th class="text-left">CODE</th>
            <th class="text-left">DESIGNATION</th>
            <th class="text-right">PU</th>
            <th class="text-right">PR</th>
            <th class="text-center">PHOTO</th>
            <th class="text-center">ACTIONS</th>
        </tr>
        <tbody id="article_rows">
            <?= $lignesArticle ?>
        </tbody>
    </table>
</div>
<script>
    document.getElementById("search_btn").href="javascript:searchArticle()";

    function touche(e){
        if(e.keyCode == 13) {
            searchArticle();
        }
    }

    function searchArticle() {
        // alert ("bonjour");
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?control=article&action=search');
        var data = new FormData();
        var mot = document.querySelector('#mot').value;
        data.append('mot', mot);
        //envoie vers php
        xhr.send(data);
        // retour de php
        xhr.onload = function() {
            var html = xhr.responseText;
            // alert (html);
            document.getElementById('article_rows').innerHTML = html;
        }
    }

    function confirmerSuppression(id) {
        if (confirm('Voulez-vous vraiment supprimer cet article ?')) {
            // redirection
            var url = "index.php?control=article&action=delete&id="+id;
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