<div class="content">
    <h1 class="my-4 text-light bg-dark text-center">Page d'accueil</h1>
</div>
<div class="content">
    <section class="m-5">
        <h2 class="text-dark">Dernières commandes</h2>
        <div class="d-flex flex-column justify-content-center alig-items-center m-5">
            <table class="table table-responsive">
                <tr>
                    <th class="text-left">CODE</th>
                    <th class="text-left">TYPE</th>
                    <th class="text-right">CLIENT</th>
                    <th class="text-right">DATE</th>
                    <th class="text-center">MONTANT</th>
                </tr>
                <tbody id="commande_row">
                    <?= $lignesCommande ?>
                </tbody>
            </table>
        </div>

    </section>
    <section class="m-5">
        <h2 class="text-dark">Liste des articles</h2>
        <div id="articleRow" class="d-flex flex-wrap justify-content-evenly m-5">
            <?= $lignesArticle ?>
        </div>
    </section>