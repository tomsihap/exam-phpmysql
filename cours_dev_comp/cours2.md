

# Développements complémentaires (2)
## Comment redimensionner mon fichier en "film_38_300x300.png" ?


Une fois votre image "film_38.png" enregistrée, vous allez (1) gérer la fonction de création de miniatures, (2) appeler correctement la nouvelle fonction.


> Nous nous situons toujours dans le `else`, *après* l'enregistrement de l'image et *avant* la partie upload.

## 1. Ajout dans le Helper de la fonction de création de miniatures

Vous ajouterez dans `helper.php` (**assurez vous bien d'appeler le helper dans save.php bien sûr !**) la fonction suivante :

```php

/**
 * Permet de créer une miniature au format 300x300 d'une image source.
 * Les extensions acceptées sont : jpg, jpeg, png et gif.
 * 
 * @param string $titreAncienneImage Titre avec extension de l'image de départ
 * @param string $extension Extension de l'image de départ
 * @param string $dossierEnregistrement Dossier de stockage des images (sans "/")
 * @param string $titreNouvelleImage Titre avec extension de l'image d'arrivée
 * 
 * @return boolean True si l'image a été créée, False s'il y a un problème d'extension.
 */
function createMiniature($titreAncienneImage, $extension, $dossierEnregistrement, $titreNouvelleImage){

        $cheminSource = $dossierEnregistrement . '/' . $titreAncienneImage;
        $cheminDestination = $dossierEnregistrement . '/' . $titreNouvelleImage;

        switch ($extension) {

            case 'jpg':
                $source = imagecreatefromjpeg($cheminSource);
                break;

            case 'jpeg':
                $source = imagecreatefromjpeg($cheminSource);
                break;

            case 'png':
                $source = imagecreatefrompng($cheminSource);
                break;

            case 'gif':
                $source = imagecreatefromgif($cheminSource);
                break;

            default:
                return false;
                break;
        }


        $destination = imagecreatetruecolor(300, 300); // On crée la miniature vide

        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
        $largeur_source = imagesx($source);
        $hauteur_source = imagesy($source);
        $largeur_destination = imagesx($destination);
        $hauteur_destination = imagesy($destination);

        // On crée la miniature
        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"
        imagejpeg($destination, $cheminDestination);

        switch ($extension) {

            case 'jpg':
                imagejpeg($destination, $cheminDestination);
                return true;
                break;

            case 'jpeg':
                imagejpeg($destination, $cheminDestination);
                return true;
                break;

            case 'png':
                imagepng($destination, $cheminDestination);
                return true;
                break;

            case 'gif':
                imagegif($destination, $cheminDestination);
                return true;
                break;

            default:
                return false;
                break;
        }
}
```


Cette fonction prend 4 arguments :
```php
/*
 * @param string $titreAncienneImage    Titre avec extension de l'image de départ
 * @param string $extension             Extension de l'image de départ
 * @param string $dossierEnregistrement Dossier de stockage des images (sans "/")
 * @param string $titreNouvelleImage    Titre avec extension de l'image d'arrivée
```

## 2. Modification du script de traitement des images

Pour rappel, nous avons, dans `save.php`, dans la partie de traitement de l'image:

```php
else {
    /**
     * PARTIE ENREGISTREMENT DE L'IMAGE
     */

    /**
     * PARTIE UPLOAD
     */
}

```

C'est entre ces deux parties que nous travaillerons ! Après avoir enregistré l'image de base, et avant de faire la partie Upload.

Après s'être assuré de **bien avoir inclus le helper**, Nous allons devoir appeler la fonction de création de miniature. Pour cela, il va falloir préparer les 4 arguments requis :

```php

$titreAncienneImage = ...;      // Le nom de l'image de départ AVEC extension
$extension = ...;               // L'extension de départ
$dossierEnregistrement = ...;   // Le dossier de stockage des images, sans "/" !!!
$titreNouvelleImage = ...;      // Le nom de la nouvelle image AVEC extension

// Enfin, on appelle la fonction !
createMiniature($titreAncienneImage, $extension, $dossierEnregistrement, $titreNouvelleImage);
```
> Aidez-vous des variables qui existent déjà ! Vous avez déjà traité plusieurs informations pour enreigstrer l'image de base.

Indice : pour préparer le `$titreNouvelleImage`, vous le composerez comme suit :

```php
$titreNouvelleImage = $nomAncienneImageSansExtension . '_300x300.' . $extension;
```


Enfin, vous prendrez soin de vérifier que l'image au format 300x300 s'enregistre bien dans le dossier de destination.