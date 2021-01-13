<?php

// Inclusion du fichier des fonctions
require 'core/functions.php';

// Connexion à la bdd
$bdd = connectDb();

$getPlaces = $bdd->query('SELECT * FROM logements');

$places = $getPlaces->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des logements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <?php include 'core/partials/topmenu.php'; ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 col-md-8 offset-md-2 py-5">
                <h1 class="pb-4 text-center">Liste des logements</h1>

                <table class="table table-hover col-12 mt-4">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Code postale</th>
                            <th>Surface</th>
                            <th>Prix</th>
                            <th>Photo</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($places as $place){
                        ?>

                            <tr>
                                <td><?php echo htmlspecialchars($place['titre']); ?></td>
                                <td><?php echo htmlspecialchars($place['adresse']); ?></td>
                                <td><?php echo htmlspecialchars($place['ville']); ?></td>
                                <td><?php echo htmlspecialchars($place['code_postale']); ?></td>
                                <td><?php echo htmlspecialchars($place['surface']); ?></td>
                                <td><?php echo htmlspecialchars($place['prix']); ?></td>
                                <td><?php echo htmlspecialchars($place['photo']); ?></td>
                                <td><?php echo ucfirst($sellOrRents[$place['type']]); ?></td>
                                <td><?php echo htmlspecialchars($place['description']); ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>