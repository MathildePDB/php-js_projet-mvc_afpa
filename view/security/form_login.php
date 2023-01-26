<div class="form-login w-50 auto mt-70">
    <h1 class="p-3">Connexion</h1>
    <form class="form-control p-5" action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
            <div class="p-4">
                    <input type="text" class="w-90 input-form" placeholder="username" name="username" id="username" value="">
                </div>
                <div class="p-4">
                    <input type="password" class="w-90 input-form" placeholder="mot de passe" name="password" id="password" value="">
                </div>
                <span style='color:red'><?= $erreur ?></span>
            </div>
        </div>
        <div class="p-5 text-center">
            <button class="btn btn-danger mx-3 btn-lg"><a class="text-light text-decoration-none" href="javascript:history.back()">Annuler</a></button>
            <button class="btn btn-success mx-3 btn-lg" type="submit" name="valider" value="valider">Valider</button>
        </div>
    </form>
</div>