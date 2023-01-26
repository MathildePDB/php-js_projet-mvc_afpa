<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appli - Gestion</title>
    <link rel="stylesheet" href="public/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="public/fontawesome/css/all.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark text-light fixed-top d-flex justify-content-between align-items-center px-3">
            <div class="flex-fill">
                <a href=""><i class="fa fa-laptop fa-2x text-light mx-3"></i></a>
            </div>
            <div class="flex-fill">
                <a href="#nav" class="navbar-toggler" data-bs-toggle="collapse">
                    <i class="fa fa-bars fa-2x text-light"></i></a>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav px-4">
                        <li class="nav-item"><a href="index.php" class="nav-link">Accueil</a></li>
                        <li class="nav-item"><a href="index.php?control=article&action=list" class="nav-link">Article</a></li>
                        <li class="nav-item"><a href="index.php?control=client&action=list" class="nav-link">Client</a></li>
                        <li class="nav-item"><a href="index.php?control=commande&action=list" class="nav-link">Commande</a></li>
                        <li class="nav-item"><a href="index.php?control=user&action=list" class="nav-link">Utilisateurs</a></li>
                        <li class="nav-item"><a href="index.php?control=role&action=list" class="nav-link">Rôles</a></li>
                        <li class="nav-item"><a href="index.php?control=groupeuser&action=list" class="nav-link">Groupes</a></li>
                    </ul>
                </div>
            </div>
            <form action="" class="form-inline mx-4" method="POST">
                <div class="input-group w-50">
                    <a href="#message" data-bs-toggle="dropdown"><i class="fa fa-bell fa-2x text-light mt-2 mxs-2"></i></a>
                    <ul class="dropdown-menu" id="message">
                        <li class="dropdown-item">
                            <table class="table table-responsive">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th>Auteur</th>
                                        <th>Message</th>
                                        <th>Lu</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_message">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="center"><input type="checkbox"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="text" name="auteur" id="auteur" class="form-control" placeholder="Nom"></td>
                                        <td><input type="text" name="content_message" id="content_message" class="form-control" placeholder="Message"></td>
                                        <td><a href="javascript:writeMessage()"><i class="fa fa-paper-plane fa-2x text-dark"></i></a></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </li>
                    </ul>
                </div>
            </form>
            <div class="flex-fill d-flex justify-content-center align-items-center">
                <input type="text" class="form-control h-50" name="mot" id="mot" placeholder="Rechercher...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" id="search_btn" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="flex-fill">
                <?php
                $username = $_SESSION['username'];
                if ($username == 'visiteur') {
                    $html = "<a href='index.php?control=security&action=login' class='nav-link'><i class='fa fa-user'></i>Se connecter</a>";
                } else {

                    $html = "<a href='index.php?control=security&action=logout' class='nav-link'><i class='fa fa-user'> $username</i></br>Se déconnecter</a>";
                }
                echo $html;
                ?>
            </div>
        </nav>
        <div class="d-flex justify-content-center m-5">
            <aside class="col-md-2 m-5 d-flex flex-column align-items-space-between">
                <div class="my-5">
                    <img src="https://picsum.photos/500" class="rounded mx-auto d-block w-50" alt="">
                </div>
                <nav>
                    <ul class="list-group list-group-flush my-5">
                        <li class="list-group-item"><a href="" class="nav-link text-dark hover-overlay ripple shadow-1-strong" data-mdb-ripple-color="light">Caisse</a></li>
                        <li class="list-group-item"><a href="" class="nav-link text-dark hover-overlay ripple shadow-1-strong" data-mdb-ripple-color="light">Fermeture</a></li>
                        <li class="list-group-item dropdown"><a href="" class="nav-link dropdown-toggle text-dark hover-overlay ripple shadow-1-strong" data-mdb-ripple-color="light" data-bs-auto-close="outside" data-bs-toggle="dropdown">Contrôles</a>
                            <ul class="dropdown-menu">
                                <li class="list-group-item"><a href="" class="nav-link text-dark hover-overlay ripple shadow-1-strong" data-mdb-ripple-color="light">Caisse</a></li>
                                <li class="list-group-item"><a href="" class="nav-link text-dark hover-overlay ripple shadow-1-strong" data-mdb-ripple-color="light">Vol</a></li>
                                <li class="list-group-item"><a href="" class="nav-link text-dark hover-overlay ripple shadow-1-strong" data-mdb-ripple-color="light">Démarque</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item"><a href="" class="nav-link text-dark">Inventaire</a></li>
                    </ul>
                </nav>
            </aside>
            <div id="section" class="col-md-9 m-5">
                <?= $content ?>
            </div>
        </div>
        <footer class="bg-dark fixed-bottom p-2">
            <p class="text-light text-center">Afpa 2022</p>
        </footer>
    </div>
    <script src="public/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <script src="public/js/myScript.js"></script>
    <script>
        document.getElementById("mot").onkeydown=touche;
        getMessage();

        function getMessage() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?control=message&action=read');
            xhr.send();
            xhr.onload = function() {
                var response = xhr.responseText;
                var data = JSON.parse(response);
                var html = data.map(function(message) {
                    return ` <tr>
                                <td>${message.auteur}</td>
                                <td>${message.message}</td>
                                <td class="center"><input type="checkbox"></td>
                            </tr> `;
                }).join('');
                document.getElementById('tbody_message').innerHTML = html;
                // ou : document.querySelector("#tbody_message")innerHTML=html;

                // alert(data);
                console.log(data);
            }
        }

        function writeMessage() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'message.php?action=write');
            var data = new FormData();
            var auteur = document.getElementById('auteur').value;
            var content_message = document.getElementById('content_message').value;
            data.append('auteur', auteur);
            data.append('content_message', content_message);
            xhr.send(data);
            xhr.onload = function() {
                var response = xhr.responseText;
                alert(response);
                //getMessage();
            }
        }
    </script>
</body>

</html>