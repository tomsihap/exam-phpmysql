

# Développements complémentaires (1)
## Comment renommer mon fichier en "film_38.png" ?

> Nous prendrons comme exemple une base de films. A vous d'adapter afin de correspondre à votre cas.

Une fois le fonctionnement de l'upload d'images terminé, vous allez déplacer le bloc de vérification du champ `$_FILES['image']` **après** l'execute.

En effet, nous voulons d'abord enregistrer notre élément **sans l'image**, récupérer l'ID de l'élément nouvellement créé, et enfin enregistrer l'image avec l'ID dans le nom de l'image.


## 1. Déplacement du bloc de validation après le execute :

Vous allez **déplacer** ce bloc de code suivant, celui qui effectue les vérifications sur l'image :
```php

/**
 * VALIDATION DE L'IMAGE
 */
if (...) { }
elseif(...) { }
elseif (...) { }
else { /* traitement de l'image */ }
```

A l'endroit suivant, c'est à dire juste après le `execute`.

```php

/**
 * ENREGISTREMENT DES DONNEES
 */
$req = "INSERT INTO films(titre, genre, duree, date_de_sortie, realisateur, acteur_principal, note, image)
            VALUES(:titre, :genre, :duree, :date_de_sortie, :realisateur, :acteur_principal, :note, :image)";

$res = $bdd->prepare($req);

$res->execute([
    'titre' => $titre,
    'genre' => $genre,
    'duree' => $duree,
    'date_de_sortie' => $dateDeSortie,
    'realisateur' => $realisateur,
    'acteur_principal' => $acteurPrincipal,
    'note' => $note,
    'image' => $image
]);

/**
 * VALIDATION DE L'IMAGE
 */
if (...) { }
elseif(...) { }
elseif (...) { }
else { /* traitement de l'image */ }

```

En effet, maintenant on attend que l'élément soit enregistré avant de traiter notre image.


## 2. Modification de la requête

Comme j'effectue l'enregistrement de mon image **après** l'enregistrement de l'élément, il va falloir modifier la requête ! En effet, je n'ai plus de `$image` à enregistrer.

Ma **requête** et mon `->execute()` ressemblent dorénanvant à cela (idem qu'au dessus, mais en enlevant le champ `image`):

```php

// On retire le champ "image" ici
$req = "INSERT INTO films(titre, genre, duree, date_de_sortie, realisateur, acteur_principal, note)
        VALUES(:titre, :genre, :duree, :date_de_sortie, :realisateur, :acteur_principal, :note)";

$res = $bdd->prepare($req);


// On retire le champ "image" dans le tableau ci-dessous aussi
$res->execute([
    'titre' => $titre,
    'genre' => $genre,
    'duree' => $duree,
    'date_de_sortie' => $dateDeSortie,
    'realisateur' => $realisateur,
    'acteur_principal' => $acteurPrincipal,
    'note' => $note
]);
```

## 3. Ajustement du nom de l'image (film_38.png)

Dans le `else { /* traitement de l'image */ }`, c'est à dire le "else" qui enregistre l'image si les validations sont passées, vous allez modifier les données de telle sorte qu'on récupère l'ID de l'image :


```php

    else {

        // On récupère le dernier ID enregistré
        $idChaussure = $bdd->lastInsertId();

        // On nomme l'image comme souhaité
        $nomImage = "film_" . $idChaussure;

        // Pensez bien à rajouter l'extension du fichier à la place de [extension] !!
        $nomImageComplet = $nomImage . "." . [extension];

        // On adapte la suite de l'enregistrement en utilisant cette fois $nomImageComplet et plus $nomAleatoire
        ...
    }

```

## 4. Mise à jour de l'élément

Nous avons (1) déplacé l'enregistrement de l'image après la création de l'élément, afin d'avoir son ID, (2) mis à jour la requête afin de ne plus enregistrer l'image immédiatement en BDD, (3) renommé l'image en "film_38.png".

Il faut dorénavant mettre à jour l'élement enregistré afin d'indiquer en base de données le nouveau nom de l'image !

Toujours dans le `else`, à la suite, vous allez ajouter l'upload :

```php

    else {

        // On récupère le dernier ID enregistré
        $idChaussure = $bdd->lastInsertId();

        // On nomme l'image comme souhaité
        $nomImage = "film_" . $idChaussure;

        // Pensez bien à rajouter l'extension du fichier à la place de [extension] !!
        $nomImageComplet = $nomImage . "." . [extension];

        // On adapte la suite de l'enregistrement en utilisant cette fois $nomImageComplet et plus $nomAleatoire
        ...

        /**
         * PARTIE UPLOAD
         */

        $reqUpload = "UPDATE films SET image = :image WHERE id = :id";

        $responseUpload = $bdd->prepare($reqUpload);

        $responseUpload->execute([
            'id' => $idElement,
            'image' => $nomImageComplet
        ]);

    }

```