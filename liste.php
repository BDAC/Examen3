<?php

require 'pdo.php';

$request = 'SELECT * FROM logement';

$response = $bdd->query($request);

$logements = $response->fetchAll(PDO::FETCH_ASSOC);

?>

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
        <div class="row mt-3 div col-12">

            <a href="index.php" class="btn btn-sm btn-secondary">
                < Retour à la page d'accueil</a> <br />
                <table style="margin-top:20px;" class="table">

                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>Titre</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Code Postal</th>
                            <th>Surface</th>
                            <th>Prix</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Photo</th>
                        </tr>
                    </thead>


                    <?php foreach ($logements as $logement) : ?>

                        <tr>
                            <td><?= $logement['id_logement'] ?></td>
                            <td><?= $logement['titre'] ?></td>
                            <td><?= $logement['adresse'] ?></td>
                            <td><?= $logement['ville'] ?></td>
                            <td><?= $logement['cp'] ?></td>
                            <td><?= $logement['surface'] ?>m2</td>
                            <td><?= $logement['prix'] ?></td>
                            <td><?= $logement['type'] ?></td>

                            <!-- ajout de 'substr' pour couper le text à 120 caractères -->
                            <td><?= substr($logement['description'], 0, 120) . ' ...'; ?></td>
                            <td><img src="uploads/<?= $logement['photo'] ?>" height="100"></td>
                        </tr>

                    <?php endforeach; ?>

                </table>

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