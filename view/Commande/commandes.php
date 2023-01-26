<div class="container">
    <h1 class="my-4 text-light bg-dark text-center">Liste des Commandes</h1>
    <a href="index.php?control=commande&action=insert_update&id=0" class="btn btn-md btn-primary my-4">Nouvelle commande</a>
    <table class="table table-responsive">
        <tr>
            <th>Numéro</th>
            <th>Type</th>
            <th>Date</th>
            <th>Client</th>
            <th class="text-end">Montant</th>
            <th class="text-center">Actions</th>
        </tr>
        <tbody id="commande_row">
            <?= $lignesCommande ?>
        </tbody>
    </table>
</div>
<script>
    document.getElementById("search_btn").href = "javascript:searchCommande()";

    function touche(e) {
        if (e.keyCode == 13) {
            searchCommande();
        }
    }

    function searchCommande() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?control=commande&action=search');
        var data = new FormData();
        var mot = document.querySelector('#mot').value;
        data.append('mot', mot);
        xhr.send(data);
        xhr.onload = function() {
            var html = xhr.responseText;
            document.getElementById('commande_row').innerHTML = html;
        }
    }

    function confirmerSuppression(id) {
        if (confirm('Voulez-vous vraiment supprimer la commande ?')) {
            // redirection
            var url = "index.php?control=commande&action=delete&id="+id;
            // alert(url);
            document.location.href=url;
        } 
    }

</script>