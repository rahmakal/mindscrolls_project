<?php
    session_start();
    include("bd.php");
    if (!isset($_SESSION["id_user"])) {
        header("Location: connect.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - MindScrolls</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-image">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-book-open-reader"></i> MindScrolls</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="livre.php">Explorer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profil.php">Mes livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Se déconnecter</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Livres Empruntés</h1>
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Titre du Livre</th>
                        <th scope="col">Date d'Emprunt</th>
                        <th scope="col">Date de Retour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $id_utilisateur = $_SESSION["id_user"];
                        $query = "SELECT livre.titre, livre.auteur, emprunt.date_emprunt, emprunt.date_retour FROM emprunt JOIN livre ON emprunt.id_livre = livre.id_livre WHERE emprunt.id_user = $id_utilisateur";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["titre"] .", ". $row["auteur"] ."</td>";
                                echo "<td>" . $row["date_emprunt"] . "</td>";
                                echo "<td>" . $row["date_retour"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun livre emprunté</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
