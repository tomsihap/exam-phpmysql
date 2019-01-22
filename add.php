<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion locative</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="lead">
                    <h1>Gestion locative</h1>
                    <h2>Ajout d'un bien immobilier</h2>
                    <small>Les champs indiqués d'une astérisque * sont obligatoires.</small>
                    <br>
                    <a href="list.php" class="btn btn-primary">< retour</a>
                </p>

                <form action="save.php" method="post" enctype="multipart/form-data">

                    <label for="titreLogement">Titre de l'annonce*</label>
                    <input type="text" id="titreLogement" class="form-control" name="titre" required>

                    <label for="adresseLogement">Adresse*</label>
                    <input type="text" id="adresseLogement" class="form-control" name="adresse" required>

                    <label for="villeLogement">Ville*</label>
                    <input type="text" id="villeLogement" class="form-control" name="ville" required>

                    <label for="cpLogement">Code postal*</label>
                    <input type="number" min="0" max="99999" id="cpLogement" class="form-control" name="cp" required>

                    <label for="surfaceLogement">Surface*</label>
                    <input type="number" min="0" step="1" id="surfaceLogement" class="form-control" name="surface" required>

                    <label for="prixLogement">Prix*</label>
                    <input type="number" min="0" step="1" id="prixLogement" class="form-control" name="prix" required>


                    <!-- Version Select -->
                    <label for="typeLogement">Type*</label>
                    <select class="form-control" name="type" id="typeLogement">
                        <option value="location">Location</option>
                        <option value="vente">Vente</option>
                    </select>

                    <!-- Version Radio -->
                    <!-- <label for="typeLogement">Type*</label>
                    <div id="typeLogement">
                        <input type="radio" name="type" value="location"> Location
                        <input type="radio" name="type" value="Vente"> Vente
                    </div> -->


                    <label for="photoLogement">Photo du bien</label>
                    <input type="file" id="photoLogement" class="form-control" name="photo">

                    <label for="descriptionLogement">Description</label>
                    <textarea class="form-control" name="description" id="descriptionLogement" cols="30" rows="10"></textarea>

                    <hr>

                    <button type="submit" class="btn btn-primary float-right">Créer mon bien</button>

                </form>

            </div>
        </div>
    </div>
</body>
</html>