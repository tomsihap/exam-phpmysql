<?php

require_once('helper.php');

$bdd = dbConnect();

$request = "SELECT * FROM logement ORDER BY id_logement DESC";
$response = $bdd->query($request);

$logements = [];

while ($logement = $response->fetch()) {
    $logements[] = $logement;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion locative - Liste des biens</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

</head>
<body>
    <div class="containe-fluid mx-3">
        <div class="row">
            <div class="col-12">
                <p class="lead">
                    <h1>Gestion locative</h1>
                    <h2>Liste de mes biens immobiliers</h2>
                    <br>
                    <a href="add.php" class="btn btn-primary">Ajouter un bien</a>
                </p>

                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Code postal</th>
                        <th>Surface</th>
                        <th>Prix</th>
                        <th>Photo</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>

                    <?php foreach($logements as $l) { ?>
                        <tr>
                            <td><?= $l['id_logement']; ?></td>
                            <td><?= $l['titre']; ?></td>
                            <td><?= cropText($l['adresse'], 50); ?></td>
                            <td><?= $l['ville']; ?></td>
                            <td><?= $l['cp']; ?></td>
                            <td><?= $l['surface']; ?> m²</td>
                            <td><?= $l['prix']; ?> €</td>
                            <td><img src="uploads/<?= $l['photo']; ?>" alt="<?= $l['titre']; ?>" height="100"></td>
                            <td><?= $l['type']; ?></td>
                            <td><?= cropText($l['description'], 50); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>