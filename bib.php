<?php
    session_start();
    include("bd.php");
    function etatlivre($idlivre){
        global $con;
        $check=mysqli_query($con,"SELECT etat from livre where id_livre=$idlivre");
        $etat=mysqli_fetch_assoc($check);
        return $etat['etat']=="disponible";
    }
    if(isset($_GET['search'])) {
        $search = mysqli_real_escape_string($con, $_GET['search']);
        $query = "SELECT * FROM livre WHERE titre LIKE '%$search%' OR auteur LIKE '%$search%' OR categorie LIKE '%$search%' OR description LIKE '%$search%' OR isbn LIKE '%$search%'";
        $result = mysqli_query($con, $query);
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
    function changerEtat(idLivre) {
        window.location.href = "changer_etat.php?id_livre=" + idLivre;
    }
    
    function supprimerLivre(idLivre) {
        if(confirm("Êtes-vous sûr de vouloir supprimer ce livre ?")) {
        window.location.href = "supprimer.php?id_livre=" + idLivre;
        }
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
            <form method="GET" action="bib.php" class="form-inline my-2 my-lg-0" >
            <div class="form-group">
            <input type="text" class="form-control mr-sm-2" name="search" placeholder="Rechercher un livre">
            </div>
            <button type="submit" class="btn btn-secondary my-2 my-sm-0"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </nav>
    
    <div class="container-fluid mt-5" style=" margin:0; max-height: 80vh; overflow-y: auto;">
        <h1 class="text-center mb-4">Bibliothèque <a href="ajouter.php" class="btn btn-lg btn-secondary ml-2">Ajouter un livre</a></h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                    if(isset($result)) {
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="card mb-4 bg-dark">';
                                echo '<div class="card-body d-flex">';
                                echo '<img src="img/'.$row['image'].'" class="img-fluid mr-3" alt="Image du livre" style="max-width: 100px;">';
                                echo '<div>';
                                echo '<h5 class="card-title text-left" style="color: whitesmoke;">'.$row['titre'].', '.$row['auteur'].'</h5>';
                                echo '<p class="card-text text-left">'.$row['description'].'</p>';
                                echo '</div>';
                                $availability = etatlivre($row['id_livre']);
                                echo '<button id="'.$row['id_livre'].'" class="btn btn-primary btn-info mt-auto ml-auto" onclick="changerEtat('.$row['id_livre'].')">' . ($availability ? "Disponible" : "Indisponible") . '</button>';
                                echo '<button class="btn btn-danger mt-auto ml-3" onclick="supprimerLivre('.$row['id_livre'].')">Supprimer</button>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        else{
                            echo '<div class="text-center">';
                            echo '<span style="font-weight:bold; color:white; text-decoration:underline;">Aucun livre trouvé.</span>';
                            echo '</div>';
                        }
                    } else {
                        
                        $query_all_books = "SELECT * FROM livre";
                        $result_all_books = mysqli_query($con, $query_all_books);
                        if(mysqli_num_rows($result_all_books) > 0) {
                            while($row_all_books = mysqli_fetch_assoc($result_all_books)) {
                                echo '<div class="card mb-4 bg-dark">';
                                echo '<div class="card-body d-flex">';
                                echo '<img src="img/'.$row_all_books['image'].'" class="img-fluid mr-3" alt="Image du livre" style="max-width: 100px;">';
                                echo '<div>';
                                echo '<h5 class="card-title text-left" style="color: whitesmoke;">'.$row_all_books['titre'].', '.$row_all_books['auteur'].'</h5>';
                                echo '<p class="card-text text-left">'.$row_all_books['description'].'</p>';
                                echo '</div>';
                                $availability = etatlivre($row_all_books['id_livre']);
                                echo '<button id="'.$row_all_books['id_livre'].'" class="btn btn-primary btn-info mt-auto ml-auto" onclick="changerEtat('.$row_all_books['id_livre'].')">' . ($availability ? "Disponible" : "Indisponible") . '</button>';
                                echo '<button class="btn btn-danger mt-auto ml-3" onclick="supprimerLivre('.$row_all_books['id_livre'].')">Supprimer</button>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "Aucun livre trouvé.";
                        }

                    }
                ?>
                
            </div>
        </div>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
