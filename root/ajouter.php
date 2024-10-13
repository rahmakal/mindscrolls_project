<?php
session_start();
include("bd.php"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $editeur = $_POST['editeur'];
    $annee_publication = $_POST['annee_publication'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $isbn = $_POST['isbn'];
    $etat = $_POST['etat'];
    if(isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $target_file = basename($file_name);
        move_uploaded_file($file_tmp, $target_file);
    }
    $query = "INSERT INTO livre (titre, auteur, editeur, annee_pub, description, categorie, isbn, etat, image) VALUES ('$titre', '$auteur', '$editeur', '$annee_publication', '$description', '$categorie', '$isbn', '$etat', '$target_file')";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('location:bib.php');
        die;
    } else {
        echo "<script>alert('Erreur lors de l\'ajout du livre : " . mysqli_error($con) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque - MindScrolls</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script>
        function saved(){
            confirm("Livre enregistré!");
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
                <li class="nav-item active">
                    <a class="nav-link" href="bib.php">Bibliothèque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="emprunt.php">Prêt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Se déconnecter</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid mt-5" style="margin:0; max-height: 80vh; overflow-y: auto;">
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark">
                    <div class="card-header" style="font-weight:bold; color: white;">Ajouter un livre</div>
                    <div class="card-body">
                        <form action="ajouter.php" method="POST" enctype="multipart/form-data" style="padding: 0 20px;">
                            <div class="form-group">
                                <label for="titre" style="color: white;">Titre du livre</label>
                                <input type="text" class="form-control" id="titre" name="titre" required>
                            </div>
                            <div class="form-group">
                                <label for="image" style="color: white;">Image du livre</label>
                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="auteur" style="color: white;">Auteur</label>
                                <input type="text" class="form-control" id="auteur" name="auteur" required>
                            </div>
                            <div class="form-group">
                                <label for="editeur" style="color: white;">Éditeur</label>
                                <input type="text" class="form-control" id="editeur" name="editeur" required>
                            </div>
                            <div class="form-group">
                                <label for="annee_publication" style="color: white;">Année de publication</label>
                                <input type="number" class="form-control" id="annee_publication" name="annee_publication" required>
                            </div>
                            <div class="form-group">
                                <label for="description" style="color: white;">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categorie" style="color: white;">Catégorie</label>
                                <input type="text" class="form-control" id="categorie" name="categorie" required>
                            </div>
                            <div class="form-group">
                                <label for="isbn" style="color: white;">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" required>
                            </div>
                            <div class="form-group">
                                <label for="etat" style="color: white;">État</label>
                                <select class="form-control" id="etat" name="etat" required>
                                    <option value="disponible">Disponible</option>
                                    <option value="indisponible">Indisponible</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-info" onclick="saved()">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>