<?php
    session_start();
    include("bd.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_user = $_POST["id_user"];
        $id_livre = $_POST["id_livre"];
        $date_emprunt = $_POST["date_emprunt"];
        $date_retour = $_POST["date_retour"];
        $query = "INSERT INTO emprunt (id_user, id_livre, date_emprunt, date_retour) VALUES ('$id_user', '$id_livre', '$date_emprunt', '$date_retour')";
        $result = mysqli_query($con, $query);
 
        if ($result) {
            header("location: emprunt.php");
            die;
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement de l'emprunt.";
        }
    
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prêt - MindScrolls</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script>
        function saved(){
            confirm("Emprunt enregistré!");
        }
    </script>

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
                    <a class="nav-link" href="bib.php">Bibliothèque</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="emprunt.php">Prêt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Se déconnecter</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Formulaire d'emprunt</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="emprunt.php" method="POST">
                    <div class="form-group">
                        <label for="id_user">ID Utilisateur</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" placeholder="Entrez l'ID utilisateur">
                    </div>
                    <div class="form-group">
                        <label for="id_livre">ID Livre</label>
                        <input type="text" class="form-control" id="id_livre" name="id_livre" placeholder="Entrez l'ID livre">
                    </div>
                    <div class="form-group">
                        <label for="date_emprunt">Date d'emprunt</label>
                        <input type="date" class="form-control" id="date_emprunt" name="date_emprunt">
                    </div>
                    <div class="form-group">
                        <label for="date_retour">Date de retour</label>
                        <input type="date" class="form-control" id="date_retour" name="date_retour">
                    </div>
                    <button type="submit" class="btn btn-primary btn-info" onclick="saved()">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
    
    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
