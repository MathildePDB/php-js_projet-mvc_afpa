<div class="container">
    <h1 class="my-4 text-light bg-dark text-center">Liste des clients</h1>
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <a href="index.php?control=client&action=insert_update&id=0" class="btn btn-md btn-primary my-4">Nouveau client</a>
        </div>
    </div>
    <table class="table table-responsive">
        <tr>
            <th class='align-middle'>NUMERO</th>
            <th class='align-middle'>TYPE</th>
            <th class='align-middle'>NOM</th>
            <th class='align-middle'>ADRESSE</th>
            <th class='align-middle'>TELEPHONE</th>
            <th class='text-center align-middle'>PHOTO</th>
            <th class='text-center align-middle'>ACTIONS</th>
        </tr>
        <tbody id="client_row">
            <?= $lignesClient ?>
        </tbody>
</div>
<script>
    document.getElementById("search_btn").href = "javascript:searchClient()";

    function touche(e){
        if(e.keyCode == 13) {
            searchClient();
        }
    }

    function searchClient() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?control=client&action=search');
        var data = new FormData();
        var mot = document.querySelector('#mot').value;
        data.append('mot', mot);
        xhr.send(data);
        xhr.onload = function() {
            var html = xhr.responseText;
            document.getElementById('client_row').innerHTML = html;
        }
    }

    function confirmerSuppression(id) {
        if (confirm('Voulez-vous vraiment supprimer ce client ?')) {
            // redirection
            var url = "index.php?control=client&action=delete&id="+id;
            // alert(url);
            document.location.href=url;
        } 
    }
</script>