<?php

require 'pdo.php';
require 'helpers.php';

if (!empty($_POST)) {

    // Controle

    if (strlen($_POST['titre']) < 3) {
        throw new Exception('Le champ titre est trop court.');
    }

    if (strlen($_POST['titre']) > 150) {
        throw new Exception('Le champ titre est trop long.');
    }

    if (strlen($_POST['adresse']) > 150) {
        throw new Exception('Le champ adresse est trop long.');
    }

    if (strlen($_POST['ville']) > 150) {
        throw new Exception('Le champ ville est trop long.');
    }

    if ($_POST['cp'] < 1000) {
        throw new Exception('Le champ code postal est incorrect.');
    }

    if ($_POST['cp'] > 100000) {
        throw new Exception('Le champ code postal est incorrect.');
    }

    if (strlen($_POST['prix']) > 150) {
        throw new Exception('Le champ prix est trop long.');
    }

    if (!is_numeric($_POST['prix'])) {
        throw new Exception('Le champ prix doit être un nombre entier.');
    }

    if (!is_numeric($_POST['surface'])) {
        throw new Exception('Le champ surface doit être un nombre entier.');
    }

    if (strlen($_POST['description']) > 500) {
        throw new Exception('Le champ description est trop long.');
    }

    /*if (isset($_FILES['photo']) and $_FILES['photo']['error'] == 0) {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['photo']['size'] <= 8000000) {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees)) {
                // On peut valider le fichier et le stocker définitivement

                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($_FILES['photo']['name']));
                echo "L'envoi a bien été effectué !";
            }
        }
    }*/

    // fin Controle

    // Ecriture sur bdd

    $request = 'INSERT INTO logement (titre, adresse, ville, cp, surface, prix, type, description, photo)
                VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :type, :description, :photo)';

    $response = $bdd->prepare($request);

    $response->execute([
        'titre'             => $_POST['titre'],
        'adresse'           => $_POST['adresse'],
        'ville'             => $_POST['ville'],
        'cp'                => $_POST['cp'],
        'surface'           => $_POST['surface'],
        'prix'              => $_POST['prix'],
        'type'              => $_POST['type'],
        'description'       => $_POST['description'],
        'photo'             => basename($_FILES['photo']['name'])
    ]);

    $id = $bdd->lastInsertId();

    $newName = 'logement_' . $id;

    if ($_FILES['photo']['error'] == 0) {

        // Testons si le fichier n'est pas trop gros
        if ($_FILES['photo']['size'] <= 8000000) {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = ['jpg', 'jpeg', 'gif', 'png'];
            if (in_array($extension_upload, $extensions_autorisees)) {
                // On peut valider le fichier et le stocker définitivement

                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' .  $newName . '.' . $extension_upload);
                echo "L'envoi a bien été effectué !";


                $request = 'UPDATE logement
                            SET photo = "' . $newName . '.' . $extension_upload . '" 
                            WHERE id_logement = ' . $id;

                $bdd->query($request);

                /**
                 * Gestion de la miniature : 
                 * Je traite mes variables afin de remplir les arguments de ma fonction createMinature,
                 * qui crééera par exemple l'image suivante : "logement_38_300x300.png"
                 */
                $titreAncienneImage = $newName . '.' . $extension_upload;       // Le nom de l'image de départ AVEC extension
                $extension = $extension_upload;                                 // L'extension de départ
                $dossierEnregistrement = 'uploads';                             // Le dossier de stockage des images, sans "/" !!!
                $titreNouvelleImage = $newName . '_300x300.' . $extension;     // Le nom de la nouvelle image AVEC extension
                $resultMiniature = createMiniature($titreAncienneImage, $extension, $dossierEnregistrement, $titreNouvelleImage);
                if (!$resultMiniature) {
                    echo "Il y a eu un problème lors de la création de la miniature.";
                    return;
                }
            }
        } else {
            throw new Exception('La photo est trop grande');
        }
    } else {
        throw new Exception('Une erreur lors de lupload de limage');
    }
}

?>

<!-- fin Ecriture sur bdd -->

<!-- HTML -->

<!doctype html>
<html lang="fr">

<head>
    <title>Immobilier</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">

                <a href="index.php" class="btn btn-sm btn-secondary">
                    < Retour à la page d'accueil</a> <hr>
                        <h1>Ajouter un logement</h1>
                        <hr>

                        <form style="padding:10px;" action="ajouter.php" method="post" class="form" enctype="multipart/form-data">

                            <!-- Pas necessaire <div class="form-group">
                                <input placeholder="Id" class="form-control" type="text" name="id_logement">
                            </div> -->

                            <div class="form-group">
                                <input placeholder="Titre" class="form-control" type="text" name="titre">
                            </div>

                            <div class="form-group">
                                <input placeholder="Adresse" class="form-control" type="text" name="adresse">
                            </div>

                            <div class="form-group">
                                <input placeholder="Ville" class="form-control" type="text" name="ville">
                            </div>

                            <div class="form-group">
                                <input placeholder="Code Postale" class="form-control" type="text" name="cp">
                            </div>

                            <div class="form-group">
                                <input placeholder="Surface" class="form-control" type="text" name="surface">
                            </div>

                            <div class="form-group">
                                <input placeholder="Prix" class="form-control" type="text" name="prix">
                            </div>

                            <div class="form-group">
                                <select placeholder="Type" class="form-control" type="text" name="type">
                                    <option value="Enchère">Enchère</option>
                                    <option value="Vente">Vente</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input placeholder="Description" class="form-control" type="text" name="description">
                            </div>

                            <div class="form-group">
                                <label for="#formField1">Insérer une image:</label><br />
                                <input type="file" name="photo">
                            </div>

                            <button class="btn btn-success float-right" type="submit">Ajouter</button>
                            <br /><br />
                        </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>