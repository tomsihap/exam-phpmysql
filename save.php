<?php

require_once('helper.php');

// var_dump($_POST);

/**
 * Test des données fournies
 * 
 * Pour rappel, titre, adresse, ville, cp, surface, prix, type sont obligatoires
 * 
 * Code postal doit être vérifié et correct
 * 
 * Prix et surface doivent être des INT+
 * 
 * Photo doit être vérifié en extension, tpye de fichier, poids du fichier...
 */


/**
 * Validation du champ titre
 */
if(empty($_POST['titre'])) {
    echo "Le champ titre est obligatoire.";
    return;
}
else { $titre = $_POST['titre']; }

/**
 * Validation du champ adresse
 */
if(empty($_POST['adresse'])) {
    echo "Le champ adresse est obligatoire.";
    return;
}
else { $adresse = $_POST['adresse']; }

/**
 * Validation du champ ville
 */
if(empty($_POST['ville'])) {
    echo "Le champ ville est obligatoire.";
    return;
}
else { $ville = $_POST['ville']; }


/**
 * Validation du champ cp
 */
if(empty($_POST['cp'])) {
    echo "Le champ cp est obligatoire.";
    return;
}
elseif(!preg_match('/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/', $_POST['cp'])) {
    echo "Le format du code postal est invalide.";
    return;
}
else { $cp = $_POST['cp']; }

/**
 * Validation du champ surface
 */
if(empty($_POST['surface'])) {
    echo "Le champ surface est obligatoire.";
    return;
}
elseif(intval($_POST['surface']) < 0) {
    echo "La surface doit être une entier positif non nul.";
}
else { $surface = $_POST['surface']; }

/**
 * Validation du champ prix
 */
if(empty($_POST['prix'])) {
    echo "Le champ prix est obligatoire.";
    return;
}
elseif(intval($_POST['prix']) < 0) {
    echo "Le prix doit être une entier positif non nul.";
}
else { $prix = $_POST['prix']; }

/**
 * Validation du champ type
 */
if(empty($_POST['type'])) {
    echo "Le champ type est obligatoire.";
    return;
}
elseif( !in_array($_POST['type'], ['location', 'vente']) ) {
    echo "Le type est invalide.";
    return;
}
else { $type = $_POST['type']; }

/**
 * Validation du champ Description
 * Uniquement en existence : si $_POST['description'] n'existe pas, alors $description est simplement égal à null.
 */
if (empty($_POST['description'])) { $description = null; }
else { $description = $_POST['description']; }

/**
 * ENREGISTREMENT EN BASE DE DONNEES
 */

if (empty($titre) || empty($adresse) || empty($ville) || empty($cp) || empty($surface) || empty($prix) || empty($type) ) {
    echo "Les champs titre, adresse, ville, code postal, surface, prix et type sont requis.";
    return;
}

else {

    $bdd = dbConnect();

    $request = "INSERT INTO logement(titre, adresse, ville, cp, surface, prix, type, description)
                VALUES(:titre, :adresse, :ville, :cp, :surface, :prix, :type, :description)";

    $response = $bdd->prepare($request);

    $response->execute([
        'titre' => $titre,
        'adresse' => $adresse,
        'ville' => $ville,
        'cp' => $cp,
        'surface' => $surface,
        'prix' => $prix,
        'type' => $type,
        'description' => $description
    ]);


    echo "L'élément a bien été enregistré !";

    /**
     * Validation de l'image
     * Pour l'existence : si $_POST['description'] n'existe pas, alors $description est simplement égal à null.
     * 
     */

    // Je liste les extensions autorisées
    $extensionsAutorisees = ['jpg', 'jpeg', 'gif', 'png'];

    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    if (empty($_FILES['photo']['name'])) { $image = null; }

    elseif($_FILES['photo']['error'] !== 0) {
        echo "Attention, erreur lors de l'upload de l'image.";
        return;
    }

    // Testons si le fichier n'est pas trop gros
    elseif ($_FILES['photo']['size'] >= 1000000) {
        echo "Attention, l'image est trop grosse.";
        return;
    }

    // Testons si l'extension est autorisée
    // J'accède à l'extension grâce à : pathinfo($_FILES['imageChaussure']['name'])['extension']
    elseif (!in_array( pathinfo($_FILES['photo']['name'])['extension'], $extensionsAutorisees) ) {
        echo "Attention, le fichier n'est pas autorisé.";
        return;
    }

    else {

        /**
         * Je récupère l'ID du logement
         */
        $idLogement = $bdd->lastInsertId();

        /**
         * Je traite l'image uploadée et l'enregistre dans uploads
         */
        $nomImage = "logement_" . $idLogement;

        $image = $nomImage . "." . pathinfo($_FILES['photo']['name'])['extension'];

        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $image );

        /**
         * Gestion de la miniature : 
         * Je traite mes variables afin de remplir les arguments de ma fonction createMinature,
         * qui crééera par exemple l'image suivante : "logement_38_300x300.png"
         */
        $titreAncienneImage = $image;                                   // Le nom de l'image de départ AVEC extension
        $extension = pathinfo($_FILES['photo']['name'])['extension'];   // L'extension de départ
        $dossierEnregistrement = 'uploads';                             // Le dossier de stockage des images, sans "/" !!!
        $titreNouvelleImage = $nomImage . '_300x300.' . $extension;     // Le nom de la nouvelle image AVEC extension

        $resultMiniature = createMiniature($titreAncienneImage, $extension, $dossierEnregistrement, $titreNouvelleImage);

        if (!$resultMiniature) {
            echo "Il y a eu un problème lors de la création de la miniature.";
            return;
        }


        /**
         * UPDATE : Je met à jour l'élément nouvellement créé afin de lui attribuer le nom de l'image traitée et renommée.
         */

        $requestUpload = "UPDATE logement SET photo = :photo WHERE id_logement = :id_logement";

        $responseUpload = $bdd->prepare($requestUpload);

        $responseUpload->execute([
            'id_logement' => $idLogement,
            'photo' => $image
        ]);

        echo "<br>";
        echo "L'image a bien été enregistrée !";
    }

    echo "<br>";
    echo "<a href='list.php'>Retour à la liste</a>";
}










