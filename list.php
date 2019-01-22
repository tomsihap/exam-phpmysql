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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="lead">
                    <h1>Gestion locative</h1>
                    <h2>Liste de mes biens immobiliers</h2>
                    <p class="lead">Légende couleurs : <span class="badge badge-info">locations</span> <span class="badge badge-success">ventes</span></p>
                    <br>
                    <a href="add.php" class="btn btn-primary">Ajouter un bien</a>
                </p>

                <table class="table">
                    <tr>
                        <th></th>
                        <th>Le bien</th>
                        <th>Caractéristiques</th>
                    </tr>

                    <?php foreach($logements as $l) { ?>
                        <tr class="<?= ($l['type'] == 'location') ? 'table-info' : 'table-success'; ?>">

                            <td><img src="uploads/<?= $l['photo']; ?>" alt="<?= $l['titre']; ?>" height="100"></td>
                            <td>
                                <strong>#<?= $l['id_logement']; ?></strong> <?= $l['titre']; ?>
                                <br>
                                <small><?= cropText($l['adresse'], 50); ?>, <?= $l['cp']; ?> <?= $l['ville']; ?></small>
                            </td>

                            <td>
                                <strong>Surface :</strong> <?= $l['surface']; ?> m²
                                <br>
                                <strong>Prix :</strong> <?= $l['prix']; ?> € <?= ($l['type'] == 'location') ? '/ mois' : ''; ?>
                                <p>
                                    <?= cropText($l['description'], 150); ?>
                                </p>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>